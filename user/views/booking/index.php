<?php
$tourName = $tour['tour_name'] ?? ($tour['title'] ?? 'Tour');
$heroImage = $tour['imageURL'] ?? ($tour['heroImage'] ?? '');
$adultPrice = (float) ($tour['priceAdult'] ?? 0);
$childPrice = (float) ($tour['priceChild'] ?? 0);
$availableSlots = (int) ($tour['quantity'] ?? 0);
?>

<style>
    .editorial-shadow {
        box-shadow: 0px 12px 32px rgba(25, 28, 29, 0.06);
    }
</style>

<main class="max-w-7xl mx-auto px-4 sm:px-8 pt-12 pb-24">
    <!-- Breadcrumb -->
    <nav class="flex items-center space-x-2 text-sm text-outline mb-10 font-medium">
        <a class="hover:text-secondary transition-colors" href="index.php?controller=home">Home</a>
        <span class="material-symbols-outlined text-xs">chevron_right</span>
        <a class="hover:text-secondary transition-colors" href="index.php?controller=tour">Tours</a>
        <span class="material-symbols-outlined text-xs">chevron_right</span>
        <span class="text-on-surface">Booking</span>
    </nav>

    <form method="POST" action="index.php?controller=booking&action=store">
        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token ?? ''); ?>">
        <input type="hidden" name="tourID" value="<?php echo (int) ($tour['tourID'] ?? 0); ?>">

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            <!-- Left Column: Forms -->
            <div class="lg:col-span-8 space-y-12">
                <!-- Billing Information -->
                <section class="bg-surface-container-lowest p-6 sm:p-10 rounded-xl editorial-shadow">
                    <div class="flex items-center space-x-3 mb-8">
                        <span class="material-symbols-outlined text-secondary" style="font-variation-settings: 'FILL' 1;">person_pin</span>
                        <h2 class="text-2xl font-headline font-bold text-on-secondary-fixed">Billing Information</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-on-surface-variant">Full Name</label>
                            <input class="w-full bg-surface-container-low border-none rounded-lg p-4 focus:ring-2 focus:ring-secondary/20 placeholder:text-outline/60 text-on-surface transition-all" placeholder="Enter your full name" type="text" value="<?php echo htmlspecialchars($account['usersname'] ?? $account['username'] ?? ''); ?>" required/>
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-on-surface-variant">Phone Number</label>
                            <input class="w-full bg-surface-container-low border-none rounded-lg p-4 focus:ring-2 focus:ring-secondary/20 placeholder:text-outline/60 text-on-surface transition-all" placeholder="Enter your phone number" type="tel"/>
                        </div>
                        <div class="md:col-span-2 space-y-2">
                            <label class="text-sm font-semibold text-on-surface-variant">Email Address</label>
                            <input class="w-full bg-surface-container-low border-none rounded-lg p-4 focus:ring-2 focus:ring-secondary/20 placeholder:text-outline/60 text-on-surface transition-all" placeholder="email@example.com" type="email" value="<?php echo htmlspecialchars($account['email'] ?? ''); ?>" required/>
                        </div>
                        <div class="md:col-span-2 space-y-2">
                            <label class="text-sm font-semibold text-on-surface-variant">Address</label>
                            <input class="w-full bg-surface-container-low border-none rounded-lg p-4 focus:ring-2 focus:ring-secondary/20 placeholder:text-outline/60 text-on-surface transition-all" placeholder="Your current address" type="text"/>
                        </div>

                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-on-surface-variant">Adults (<?php echo number_format($adultPrice, 0, ',', '.'); ?>₫)</label>
                            <input id="numAdults" name="numAdults" class="w-full bg-surface-container-low border-none rounded-lg p-4 focus:ring-2 focus:ring-secondary/20 text-on-surface transition-all" type="number" min="1" value="1" required/>
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-on-surface-variant">Children (<?php echo number_format($childPrice, 0, ',', '.'); ?>₫)</label>
                            <input id="numChildren" name="numChildren" class="w-full bg-surface-container-low border-none rounded-lg p-4 focus:ring-2 focus:ring-secondary/20 text-on-surface transition-all" type="number" min="0" value="0" required/>
                        </div>

                        <div class="md:col-span-2 space-y-2">
                            <label class="text-sm font-semibold text-on-surface-variant">Message/Notes (Optional)</label>
                            <textarea name="specialRequests" class="w-full bg-surface-container-low border-none rounded-lg p-4 focus:ring-2 focus:ring-secondary/20 placeholder:text-outline/60 text-on-surface transition-all resize-none" placeholder="Special requests or notes for your trip..." rows="4"></textarea>
                        </div>
                    </div>
                </section>

                <!-- Payment Method -->
                <section class="bg-surface-container-lowest p-6 sm:p-10 rounded-xl editorial-shadow" id="payment-methods">
                    <div class="flex items-center space-x-3 mb-8">
                        <span class="material-symbols-outlined text-secondary" style="font-variation-settings: 'FILL' 1;">payments</span>
                        <h2 class="text-2xl font-headline font-bold text-on-secondary-fixed">Payment Method</h2>
                    </div>
                    
                    <div class="space-y-4">
                        <!-- Cash at office -->
                        <label class="block relative cursor-pointer group border-2 border-outline-variant/30 rounded-lg overflow-hidden transition-all has-[:checked]:border-secondary has-[:checked]:bg-surface-container-low">
                            <div class="p-4 flex items-center space-x-4 bg-white">
                                <input type="radio" name="paymentMethod" value="cash" class="w-5 h-5 text-secondary border-2 border-outline-variant focus:ring-secondary/20 transition-all shrink-0">
                                <div class="flex items-center space-x-3">
                                    <span class="material-symbols-outlined text-on-surface-variant group-has-[:checked]:text-secondary transition-colors">payments</span>
                                    <span class="font-medium text-on-surface-variant group-has-[:checked]:text-secondary group-has-[:checked]:font-bold transition-colors">Cash at the office</span>
                                </div>
                            </div>
                        </label>

                        <!-- Bank Transfer -->
                        <label class="block relative cursor-pointer group border-2 border-outline-variant/30 rounded-lg overflow-hidden transition-all has-[:checked]:border-secondary has-[:checked]:bg-surface-container-low">
                            <div class="p-4 flex items-center space-x-4 bg-white">
                                <input type="radio" name="paymentMethod" value="bank" class="w-5 h-5 text-secondary border-2 border-outline-variant focus:ring-secondary/20 transition-all shrink-0" checked>
                                <div class="flex items-center space-x-3">
                                    <span class="material-symbols-outlined text-on-surface-variant group-has-[:checked]:text-secondary transition-colors" style="font-variation-settings: 'FILL' 1;">account_balance</span>
                                    <span class="font-medium text-on-surface-variant group-has-[:checked]:font-bold group-has-[:checked]:text-secondary transition-colors">Bank Transfer</span>
                                </div>
                            </div>
                            <div class="hidden group-has-[:checked]:block p-6 space-y-4 text-sm leading-relaxed border-t border-outline-variant/20 bg-surface-container-low">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-on-surface-variant font-medium">Company Name</p>
                                        <p class="font-bold text-on-surface">Công ty TNHH Dịch vụ - Du lịch Việt Sun</p>
                                    </div>
                                    <div>
                                        <p class="text-on-surface-variant font-medium">Account Number</p>
                                        <p class="font-bold text-secondary text-lg">052704070022108</p>
                                    </div>
                                    <div class="md:col-span-2">
                                        <p class="text-on-surface-variant font-medium">Bank</p>
                                        <p class="font-bold text-on-surface">Ngân hàng TMCP Phát triển Thành phố Hồ Chí Minh (HD Bank), Chi nhánh Nam Kỳ Khởi Nghĩa</p>
                                    </div>
                                    <div class="md:col-span-2 bg-secondary/5 p-4 rounded-lg border border-secondary/10">
                                        <p class="text-secondary font-bold mb-1">Transfer Syntax</p>
                                        <p class="font-mono text-on-surface-variant tracking-wider uppercase">HỌ TÊN_SỐ ĐIỆN THOẠI_TÊN TOUR</p>
                                    </div>
                                </div>
                            </div>
                        </label>

                        <!-- QR Code -->
                        <label class="block relative cursor-pointer group border-2 border-outline-variant/30 rounded-lg overflow-hidden transition-all has-[:checked]:border-secondary has-[:checked]:bg-surface-container-low">
                            <div class="p-4 flex items-center space-x-4 bg-white">
                                <input type="radio" name="paymentMethod" value="qr" class="w-5 h-5 text-secondary border-2 border-outline-variant focus:ring-secondary/20 transition-all shrink-0">
                                <div class="flex items-center space-x-3">
                                    <span class="material-symbols-outlined text-on-surface-variant group-has-[:checked]:text-secondary transition-colors">qr_code_2</span>
                                    <span class="font-medium text-on-surface-variant group-has-[:checked]:font-bold group-has-[:checked]:text-secondary transition-colors">Bank Transfer via QR Code</span>
                                </div>
                            </div>
                            <div class="hidden group-has-[:checked]:block p-6 text-center border-t border-outline-variant/20 bg-surface-container-low">
                                <p class="text-sm text-on-surface-variant mb-4">Please scan the QR code below using your banking app to complete the payment.</p>
                                <div class="inline-block p-4 bg-white rounded-xl shadow-sm border border-outline-variant/20">
                                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=ChuyenTienVietSunTravel" alt="QR Code" class="w-48 h-48 mx-auto opacity-90" />
                                </div>
                                <p class="text-xs text-on-surface-variant mt-4 font-mono uppercase tracking-wider">Content: HỌ TÊN_SỐ ĐIỆN THOẠI_TÊN TOUR</p>
                            </div>
                        </label>
                    </div>
                </section>
            </div>

            <!-- Right Column: Order Summary -->
            <aside class="lg:col-span-4 sticky top-28">
                <div class="bg-surface-container-lowest rounded-xl editorial-shadow overflow-hidden">
                    <div class="h-56 relative bg-slate-100">
                        <?php if ($heroImage): ?>
                            <img alt="<?php echo htmlspecialchars($tourName); ?>" class="w-full h-full object-cover" src="<?php echo htmlspecialchars($heroImage); ?>" />
                        <?php endif; ?>
                        <div class="absolute top-4 left-4 bg-secondary-container/40 backdrop-blur-md px-3 py-1 rounded-full text-white text-xs font-bold uppercase tracking-widest">
                            Tour Summary
                        </div>
                    </div>
                    
                    <div class="p-6 sm:p-8 space-y-6">
                        <h3 class="text-xl font-headline font-bold text-on-secondary-fixed leading-snug">
                            <?php echo htmlspecialchars($tourName); ?>
                        </h3>
                        
                        <div class="space-y-3 pt-4 border-t border-outline-variant/20">
                            <div class="flex justify-between text-sm">
                                <span class="text-outline">Quantity</span>
                                <span class="font-bold" id="displayQuantity">1 Adult</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-outline">Duration</span>
                                <span class="font-bold"><?php echo htmlspecialchars($tour['duration'] ?? 'N/A'); ?></span>
                            </div>
                            <div class="flex justify-between text-sm text-secondary">
                                <span class="text-secondary/70">Available Slots</span>
                                <span class="font-bold"><?php echo number_format($availableSlots); ?></span>
                            </div>
                            
                            <div class="flex justify-between items-end pt-4 border-t border-outline-variant/20">
                                <span class="text-on-surface-variant font-bold">Total Amount</span>
                                <span class="text-3xl font-display font-extrabold text-on-primary-container" id="bookingTotal">
                                    <?php echo number_format($adultPrice, 0, ',', '.'); ?>₫
                                </span>
                            </div>
                        </div>
                        
                        <button type="submit" class="w-full bg-on-primary-container text-white py-5 rounded-lg font-bold text-lg shadow-lg shadow-on-primary-container/20 hover:scale-[1.02] active:scale-95 transition-all flex items-center justify-center space-x-2">
                            <span>Đặt tour</span>
                            <span class="material-symbols-outlined">arrow_forward</span>
                        </button>
                        
                        <p class="text-center text-xs text-outline leading-relaxed">
                            By clicking "Đặt tour", you agree to our <a class="underline hover:text-secondary" href="#">Terms of Service</a> and <a class="underline hover:text-secondary" href="#">Privacy Policy</a>.
                        </p>
                    </div>
                </div>
                
                <!-- Trusted Badge -->
                <div class="mt-8 flex items-center justify-center space-x-4 opacity-60">
                    <span class="material-symbols-outlined text-secondary">verified_user</span>
                    <span class="text-sm font-medium">Secure SSL Encrypted Payment</span>
                </div>
            </aside>
        </div>
    </form>
</main>

<script>
    (function () {
        const adultInput = document.getElementById('numAdults');
        const childInput = document.getElementById('numChildren');
        const totalLabel = document.getElementById('bookingTotal');
        const displayQuantity = document.getElementById('displayQuantity');
        const adultPrice = <?php echo json_encode($adultPrice); ?>;
        const childPrice = <?php echo json_encode($childPrice); ?>;

        function formatMoney(value) {
            return new Intl.NumberFormat('vi-VN').format(value) + '₫';
        }

        function updateTotal() {
            const adults = Math.max(1, parseInt(adultInput.value || '1', 10));
            const children = Math.max(0, parseInt(childInput.value || '0', 10));
            
            const total = (adults * adultPrice) + (children * childPrice);
            totalLabel.textContent = formatMoney(total);
            
            let quantityText = adults + ' Adult' + (adults > 1 ? 's' : '');
            if (children > 0) {
                quantityText += ', ' + children + ' Child' + (children > 1 ? 'ren' : '');
            }
            displayQuantity.textContent = quantityText;
        }

        if(adultInput && childInput) {
            adultInput.addEventListener('input', updateTotal);
            childInput.addEventListener('input', updateTotal);
            updateTotal();
        }
    })();
</script>
