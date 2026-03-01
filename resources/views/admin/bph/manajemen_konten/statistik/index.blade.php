<x-admin.bph.layouts>
    <x-slot:title>Kelola {{ $title }}</x-slot:title>
    
    <!-- Cards -->
    <div class="w-full max-w-5xl mx-auto mb-6">
        <h3 class="text-lg font-semibold text-gray-800 text-center mb-6">
            Card Pengunjung Website UKMBSM ITERA
        </h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">            

            <!-- Total Pengunjung -->
            <div class="group bg-white p-6 rounded-2xl shadow-md flex items-center gap-4 transition-all duration-300 hover:shadow-xl border border-gray-100 hover:border-green-500">
                <div class="bg-green-100 text-green-600 group-hover:bg-green-500 group-hover:text-white transition duration-300 p-3 rounded-xl">
                    <!-- icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Total Pengunjung</p>
                    <p class="text-2xl font-bold text-gray-800 mt-1">
                        {{ number_format($totalVisitors ?? 0) }} Visitor
                    </p>
                </div>
            </div>

            <!-- Bulan Ini -->
            <div class="group bg-white p-6 rounded-2xl shadow-md flex items-center gap-4 transition-all duration-300 hover:shadow-xl border border-gray-100 hover:border-blue-500">
                <div class="bg-blue-100 text-blue-600 group-hover:bg-blue-500 group-hover:text-white transition duration-300 p-3 rounded-xl">
                    <!-- icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Pengunjung Bulan Ini</p>
                    <p class="text-2xl font-bold text-gray-800 mt-1">
                        {{ number_format($thisMonth ?? 0) }} Visitor
                    </p>
                </div>
            </div>

            <!-- Hari Teramai -->
            <div class="group bg-white p-6 rounded-2xl shadow-md flex items-center gap-4 transition-all duration-300 hover:shadow-xl border border-gray-100 hover:border-red-500">
                <div class="bg-red-100 text-red-600 group-hover:bg-red-500 group-hover:text-white transition duration-300 p-3 rounded-xl">
                    <!-- icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.362 5.214A8.252 8.252 0 0 1 12 21 8.25 8.25 0 0 1 6.038 7.047 8.287 8.287 0 0 0 9 9.601a8.983 8.983 0 0 1 3.361-6.867 8.21 8.21 0 0 0 3 2.48Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 18a3.75 3.75 0 0 0 .495-7.468 5.99 5.99 0 0 0-1.925 3.547 5.975 5.975 0 0 1-2.133-1.001A3.75 3.75 0 0 0 12 18Z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Hari Teramai</p>
                    <p class="text-lg font-bold text-gray-800 mt-1">
                        {{ $peakDay ?? '-' }}
                    </p>
                </div>
            </div>

        </div>
    </div>

    <!-- Line Chart Card -->
    <div class="w-full max-w-5xl mx-auto mt-10 bg-white p-6 rounded-2xl shadow-md">

        <!-- Header + Mode Switch -->
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-800">
                Grafik Pengunjung Website UKMBSM ITERA
            </h3>

            <div class="flex gap-2">
                <a href="?mode=7d"
                class="px-3 py-1.5 rounded-lg text-sm font-medium 
                {{ request('mode','7d')=='7d' ? 'bg-amber-500 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    7 Hari
                </a>

                <a href="?mode=30d"
                class="px-3 py-1.5 rounded-lg text-sm font-medium 
                {{ request('mode')=='30d' ? 'bg-amber-500 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    30 Hari
                </a>

                <a href="?mode=year"
                class="px-3 py-1.5 rounded-lg text-sm font-medium 
                {{ request('mode')=='year' ? 'bg-amber-500 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    Per Bulan
                </a>
                <form method="GET" class="flex gap-2">
                    <input type="hidden" name="mode" value="{{ request('mode','7d') }}">

                    <select name="year" onchange="this.form.submit()"
                        class="px-3 py-1.5 rounded-lg border text-sm">
                        @for ($y = now()->year; $y >= 2024; $y--)
                            <option value="{{ $y }}" {{ request('year', now()->year) == $y ? 'selected' : '' }}>
                                {{ $y }}
                            </option>
                        @endfor
                    </select>
                </form>
            </div>            
        </div>

        <canvas id="visitorChart" height="100"></canvas>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const labels = JSON.parse('@json($chartLabels ?? [])');
        const data = JSON.parse('@json($chartData ?? [])');

        const ctx = document.getElementById('visitorChart');

        if (ctx) {
            const gradient = ctx.getContext('2d').createLinearGradient(0, 0, 0, 300);
            gradient.addColorStop(0, 'rgba(245, 158, 11, 0.4)');
            gradient.addColorStop(1, 'rgba(245, 158, 11, 0.05)');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Jumlah Pengunjung',
                        data: data,
                        tension: 0.4,
                        fill: true,
                        backgroundColor: gradient,
                        borderColor: '#f59e0b',
                        borderWidth: 2,
                        pointRadius: 3,
                        pointBackgroundColor: '#f59e0b',
                    }]
                },
                options: {
                    responsive: true,
                    plugins: { legend: { display: false } },
                    scales: { y: { beginAtZero: true } }
                }
            });
        }
    </script>

</x-admin.bph.layouts>
