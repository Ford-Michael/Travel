<?php
/**
 * Minimal PDF generator for plain-text reports.
 * Uses built-in Helvetica font and simple line-based layout.
 */

class SimplePdf {
    private $pages = [];
    private $currentPage = '';
    private $currentY = 800;
    private $leftMargin = 50;
    private $lineHeight = 16;
    private $pageWidth = 595;
    private $pageHeight = 842;
    private $maxCharsPerLine = 95;

    public function addPage() {
        if ($this->currentPage !== '') {
            $this->pages[] = $this->currentPage;
        }

        $this->currentPage = '';
        $this->currentY = 800;
    }

    public function addTitle($text) {
        $this->ensurePage();
        $this->writeLine($text, 18);
        $this->currentY -= 8;
    }

    public function addSubtitle($text) {
        $this->ensurePage();
        $this->writeLine($text, 13);
    }

    public function addLine($text = '') {
        $this->ensurePage();

        if ($text === '') {
            $this->currentY -= $this->lineHeight;
            return;
        }

        foreach ($this->wrapText($text) as $line) {
            if ($this->currentY < 60) {
                $this->addPage();
            }

            $this->writeLine($line, 11);
        }
    }

    public function addKeyValue($label, $value) {
        $this->addLine($label . ': ' . $value);
    }

    public function addSection($title, array $lines) {
        $this->addLine();
        $this->addSubtitle($title);
        foreach ($lines as $line) {
            $this->addLine($line);
        }
    }

    public function output($filename = 'document.pdf') {
        if ($this->currentPage !== '') {
            $this->pages[] = $this->currentPage;
            $this->currentPage = '';
        }

        if (empty($this->pages)) {
            $this->addPage();
            $this->pages[] = $this->currentPage;
        }

        $objects = [];

        $objects[] = "<< /Type /Catalog /Pages 2 0 R >>";

        $kids = [];
        $pageObjectNumbers = [];
        $contentObjectNumbers = [];
        $objectNumber = 3;

        foreach ($this->pages as $pageContent) {
            $pageObjectNumbers[] = $objectNumber++;
            $contentObjectNumbers[] = $objectNumber++;
        }

        $kidsRefs = [];
        foreach ($pageObjectNumbers as $pageNumber) {
            $kidsRefs[] = $pageNumber . " 0 R";
        }

        $objects[] = "<< /Type /Pages /Kids [ " . implode(' ', $kidsRefs) . " ] /Count " . count($pageObjectNumbers) . " >>";
        $fontObjectNumber = $objectNumber++;

        foreach ($pageObjectNumbers as $index => $pageNumber) {
            $contentNumber = $contentObjectNumbers[$index];
            $objects[] = "<< /Type /Page /Parent 2 0 R /MediaBox [0 0 {$this->pageWidth} {$this->pageHeight}] /Resources << /Font << /F1 {$fontObjectNumber} 0 R >> >> /Contents {$contentNumber} 0 R >>";
            $stream = "BT\n/F1 11 Tf\n" . $this->pages[$index] . "ET";
            $objects[] = "<< /Length " . strlen($stream) . " >>\nstream\n" . $stream . "\nendstream";
        }

        $objects[] = "<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica >>";

        $pdf = "%PDF-1.4\n";
        $offsets = [0];

        foreach ($objects as $index => $object) {
            $offsets[] = strlen($pdf);
            $pdf .= ($index + 1) . " 0 obj\n" . $object . "\nendobj\n";
        }

        $xrefOffset = strlen($pdf);
        $pdf .= "xref\n0 " . (count($objects) + 1) . "\n";
        $pdf .= "0000000000 65535 f \n";

        for ($i = 1; $i <= count($objects); $i++) {
            $pdf .= str_pad((string) $offsets[$i], 10, '0', STR_PAD_LEFT) . " 00000 n \n";
        }

        $pdf .= "trailer\n<< /Size " . (count($objects) + 1) . " /Root 1 0 R >>\n";
        $pdf .= "startxref\n" . $xrefOffset . "\n%%EOF";

        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Content-Length: ' . strlen($pdf));
        header('Cache-Control: private, max-age=0, must-revalidate');

        echo $pdf;
        exit;
    }

    private function ensurePage() {
        if ($this->currentPage === '') {
            $this->addPage();
        }
    }

    private function writeLine($text, $fontSize = 11) {
        $escaped = $this->escapePdfText($text);
        $this->currentPage .= "BT /F1 {$fontSize} Tf 1 0 0 1 {$this->leftMargin} {$this->currentY} Tm ({$escaped}) Tj ET\n";
        $this->currentY -= ($fontSize >= 18 ? 24 : ($fontSize >= 13 ? 18 : $this->lineHeight));
    }

    private function wrapText($text) {
        $normalized = preg_replace('/\s+/', ' ', trim((string) $text));
        if ($normalized === '') {
            return [''];
        }

        $wrapped = wordwrap($normalized, $this->maxCharsPerLine, "\n", true);
        return explode("\n", $wrapped);
    }

    private function escapePdfText($text) {
        $text = iconv('UTF-8', 'Windows-1252//TRANSLIT//IGNORE', (string) $text);
        $text = str_replace('\\', '\\\\', $text);
        $text = str_replace('(', '\\(', $text);
        $text = str_replace(')', '\\)', $text);
        return str_replace(["\r", "\n"], ' ', $text);
    }
}
