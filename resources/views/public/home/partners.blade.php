<!-- Logo Partner / Mitra / Sponsor -->
<section class="py-12">
    <div class="max-w-6xl mx-auto px-6">
        <div class="text-center mb-16">
            <div class="inline-flex items-center justify-center gap-3 mb-2">
                <span class="h-[1px] w-8 bg-[#E63946]"></span>
                <span class="text-[#457B9D] text-[10px] font-black uppercase tracking-[0.5em]">Network & Partners</span>
                <span class="h-[1px] w-8 bg-[#E63946]"></span>
            </div>
            <h2 class="text-3xl font-black text-[#0A192F] uppercase tracking-tighter">
                Mitra <span class="text-[#457B9D]">Kerjasama</span>
            </h2>
        </div>

        <div class="grid md:grid-cols-2 gap-12">

            <!-- Kolom Internal -->
            <div>
                <h3 class="text-lg text-center font-semibold mb-6 text-gray-800">Internal</h3>
                <!-- Institusi -->
                 @if(isset($internalMitras['institusi']))
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-8 mb-6 place-items-center">
                        @foreach ($internalMitras['institusi'] as $mitra)
                        <a href="{{ $mitra->url }}" target="_blank">
                            <img src="{{ asset('storage/' . $mitra->logo) }}"alt="{{ $mitra->name }}"class="partner-logo h-12 object-contain"/>
                        </a>
                         @endforeach
                    </div>
                @elseif(empty($internalMitras['institusi']))
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-8 place-items-center">
                        <img src="{{ asset('assets/img/dummy/dummy.png') }}" alt="Dummy" class="partner-logo h-12 object-contain" />
                    </div>
                @endif

                <!-- Ormawa -->
                <div class="grid md:grid-cols-2 gap-12">

                    <!-- HMPS -->                     
                    <div>
                        <h5 class="text-sm font-medium text-center mb-4 text-gray-600 dark:text-gray-400">HMPS</h5>
                        @if(isset($internalMitras['ormawa_hmps']))
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-8 place-items-center">
                                @foreach ($internalMitras['ormawa_hmps'] as $mitra)
                                <a href="{{ $mitra->url }}" target="_blank">
                                    <img src="{{ asset('storage/' . $mitra->logo) }}" alt="{{ $mitra->name }}" class="partner-logo h-12 object-contain" />
                                </a>
                                @endforeach
                            </div>
                        @elseif(empty($internalMitras['ormawa_hmps']))
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-8 place-items-center">
                                 <img src="{{ asset('assets/img/dummy/dummy.png') }}" alt="Dummy" class="partner-logo h-12 object-contain" />
                            </div>
                        @endif
                    </div>

                    <!-- UKM -->
                    <div>
                        <h5 class="text-sm font-medium text-center mb-4 text-gray-600 dark:text-gray-400">UKM</h5>
                        @if(isset($internalMitras['ormawa_ukm']))
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-8 place-items-center">
                                @foreach ($internalMitras['ormawa_ukm'] as $mitra)
                                <a href="{{ $mitra->url }}" target="_blank">
                                    <img src="{{ asset('storage/' . $mitra->logo) }}" alt="{{ $mitra->name }}" class="partner-logo h-12 object-contain" />
                                </a>
                                @endforeach
                            </div>
                        @elseif(empty($internalMitras['ormawa_ukm']))
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-8 place-items-center">
                                 <img src="{{ asset('assets/img/dummy/dummy.png') }}" alt="Dummy" class="partner-logo h-12 object-contain" />
                            </div>
                        @endif
                    </div>

                </div>
            </div>

            <!-- Kolom Eksternal -->
            <div>
                <h3 class="text-lg text-center font-semibold mb-6 text-gray-800">Eksternal</h3>
                <div class="grid md:grid-cols-2 gap-12">

                    <!-- UKMBS -->
                    <div>
                        <h5 class="text-sm font-medium text-center mb-4 text-gray-600 dark:text-gray-400">UKMBS</h5>
                        @if(isset($eksternalMitras['ukmbs']))
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-8 place-items-center">
                                @foreach ($eksternalMitras['ukmbs'] as $mitra)
                                <a href="{{ $mitra->url }}" target="_blank">
                                    <img src="{{ asset('storage/' . $mitra->logo) }}" alt="{{ $mitra->name }}" class="partner-logo h-12 object-contain" />
                                </a>
                                @endforeach
                            </div>
                        @elseif(empty($eksternalMitras['ukmbs']))
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-8 place-items-center">
                                 <img src="{{ asset('assets/img/dummy/dummy.png') }}" alt="Dummy" class="partner-logo h-12 object-contain" />
                            </div>
                        @endif
                    </div>

                    <!-- Komunitas Seni -->
                    <div>
                        <h5 class="text-sm font-medium text-center mb-4 text-gray-600 dark:text-gray-400">Komunitas Seni Lainnya</h5>
                            @if(isset($eksternalMitras['komunitas']))
                                <div class="grid grid-cols-2 sm:grid-cols-3 gap-8 place-items-center">
                                    @foreach ($eksternalMitras['komunitas'] as $mitra)
                                    <a href="{{ $mitra->url }}" target="_blank">
                                        <img src="{{ asset('storage/' . $mitra->logo) }}" alt="{{ $mitra->name }}" class="partner-logo h-12 object-contain" />
                                    </a>
                                    @endforeach
                                </div>
                            @elseif(empty($eksternalMitras['komunitas']))
                                <div class="grid grid-cols-2 sm:grid-cols-3 gap-8 place-items-center">
                                    <img src="{{ asset('assets/img/dummy/dummy.png') }}" alt="Dummy" class="partner-logo h-12 object-contain" />
                                </div>
                            @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
