<div>
    <div class="grid grid-cols-3 gap-4 w-full">
        <div class="col-span-2 max-[1400px]:col-span-3 bg-white shadow rounded-lg h-[29rem]">
            <div class="p-4 pb-0">
                <h1 class="text-3xl font-semibold">
                    {{ $totalViolationsLast30Days }}
                </h1>
                <p class="text-gray-500 text-md">Violations last 30 days</p>
            </div>
            <!-- Tambahkan absolute dan full size -->
            <div class="relative pb-8 w-full h-96">
                @if ($violationsOverTime)
                    <div id="violationsOverTime" class="absolute inset-0 pt-10"></div>
                @else
                    <x-empty-table class="h-full" />
                @endif
            </div>
        </div>

        <!-- Chart Pelanggaran Per Kategori -->
        <div
            class="max-[1400px]:col-span-1 max-[900px]:col-span-3 flex justify-center flex-col items-center p-4 bg-white shadow rounded-lg h-[29rem]">
            <h2 class="text-2xl font-semibold mb-2">Top 5 Sekolah Pelanggaran Tertinggi</h2>
            @if ($topSchoolViolations)
                <div class="w-[80%] max-[1800px]:w-[110%] max-[900px]:w-[60%] max-[600px]:w-full"
                    id="topSchoolViolationsChart"></div>
            @else
                <x-empty-table class="h-full" />
            @endif
        </div>

        <!-- Top 5 Siswa Pelanggaran -->
        {{-- <div class="col-span-1 max-[1400px]:col-span-2 max-[900px]:col-span-3 bg-white p-4 shadow rounded-lg">
            <h2 class="text-xl font-semibold mb-4">Top 5 Siswa Pelanggar Tertinggi</h2>
            <ul class="space-y-2 h-96">
                @if ($topViolatingStudents)
                    @foreach ($topViolatingStudents as $index => $student)
                        <li class="flex justify-between items-center bg-white border-b-2 p-2">
                            <div class="flex items-center">
                                <h1 class="text-xl font-bold mr-4">{{ $index + 1 }}</h1>
                                @php
                                    $defaultPhoto =
                                        $student['gender'] == 'L'
                                            ? 'profile_photos/man.png'
                                            : 'profile_photos/woman.png';
                                @endphp
                                <img src="{{ $student['photo'] ? Storage::url($student['photo']) : Storage::url($defaultPhoto) }}"
                                    alt="Student Photo" class="w-12 h-12 rounded-full">
                                <h1 class="ml-4 text-lg">
                                    {{ $student['name'] }}
                                </h1>
                            </div>
                            <h1 class="font-semibold">
                                {{ $student['total'] . ' Violations' }}
                            </h1>
                        </li>
                    @endforeach
                @else
                    <x-empty-table class="h-full" />
                @endif
            </ul>
        </div> --}}


        <!-- Top 5 Guru Pelapor -->
        {{-- @if (Auth::user()->role === 'admin')
            <div class="col-span-1 max-[1400px]:col-span-2 max-[900px]:col-span-3 bg-white p-4 shadow rounded-lg">
                <h2 class="text-xl font-semibold mb-4">Top 5 Guru Pelapor</h2>
                <ul class="space-y-2">
                    @if ($topReportingTeachers)
                        @foreach ($topReportingTeachers as $index => $teacher)
                            <li class="flex justify-between items-center bg-white border-b-2 p-2">
                                <div class="flex items-center">
                                    <h1 class="text-xl font-bold mr-4">{{ $index + 1 }}</h1>
                                    <img src="{{ Storage::url($teacher['photo']) }}" alt="Teacher Photo"
                                        class="w-12 h-12 rounded-full">
                                    <h1 class="ml-4 text-lg">
                                        {{ $teacher['name'] }}
                                    </h1>
                                </div>
                                <h1 class="font-semibold">
                                    {{ $teacher['total'] . ' Reports' }}
                                </h1>
                            </li>
                        @endforeach
                    @else
                        <x-empty-table class="h-full" />
                    @endif
                </ul>
            </div>
        @endif --}}

        <!-- Newest Violations -->
        <div class="col-span-1 max-[900px]:col-span-3 bg-white p-6 shadow rounded-lg">
            <h2 class="text-xl font-semibold mb-4">Newest Violations</h2>
            <ul
                class="space-y-4 h-96 overflow-y-auto [&::-webkit-scrollbar]:w-1 [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500">
                @if ($newestViolations)
                    @foreach ($newestViolations as $index => $nw)
                        <li class="flex justify-between items-center bg-blue-100 border border-blue-500 rounded-md p-2">
                            <div class="flex flex-col">
                                <h1 class="text-base">
                                    {{ $nw['violation_category']['name'] }}
                                </h1>
                                <p class="text-sm text-gray-600">
                                    {{ $nw['school']['name'] }}
                                </p>
                            </div>
                            <p class="text-base text-gray-600">
                                {{ \Carbon\Carbon::parse($nw['created_at'])->diffForHumans() }}
                            </p>
                        </li>
                    @endforeach
                @else
                    <x-empty-table class="h-full" />
                @endif
            </ul>
        </div>

        {{-- <div class="w-[49%]">
            <!-- Chart Pelanggaran Per Hari -->
            

            <!-- Chart Pelanggaran Per Bulan -->
            <div class="bg-white p-4 shadow-2 rounded-lg">
                <h2 class="text-lg font-semibold mb-2">Violations by Month</h2>
                <div id="violationsByMonthChart"></div>
            </div>
        </div> --}}

    </div>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            initViolationDayChart();
            initTopSchoolViolationsChart();
        });

        document.addEventListener("livewire:navigated", function() {
            initViolationDayChart();
            initTopSchoolViolationsChart();
        });

        function initViolationDayChart() {
            var options = {
                chart: {
                    type: 'area',
                    height: "100%", // Pastikan mengambil full height dari parent
                    width: "100%",
                },
                dataLabels: {
                    enabled: false
                },
                series: [{
                    name: "Violations Count",
                    data: @json(array_values($violationsOverTime))
                }],
                xaxis: {
                    categories: @json(array_keys($violationsOverTime))
                }
            }

            var chartElement = document.querySelector("#violationsOverTime");

            if (chartElement) {
                chartElement.innerHTML = "";
                var chart = new ApexCharts(chartElement, options);
                chart.render();
            }
        }

        function initTopSchoolViolationsChart() {
            var options = {
                chart: {
                    type: 'donut'
                },
                legend: {
                    position: 'bottom'
                },
                series: @json(array_column($topSchoolViolations, 'total')),
                labels: @json(array_column($topSchoolViolations, 'school_name'))
            }

            var chartElement = document.querySelector("#topSchoolViolationsChart");

            if (chartElement) {
                chartElement.innerHTML = "";
                var chart = new ApexCharts(chartElement, options);
                chart.render();
            }
        }

        new ApexCharts(document.querySelector("#violationsByMonthChart"), {
            chart: {
                type: 'area',
                toolbar: {
                    show: false
                }
            },
            legend: {
                horizontalAlign: 'left'
            },
            series: [{
                name: "Pelanggaran",
                data: @json(array_values($violationsByMonth))
            }],
            xaxis: {
                categories: @json(array_keys($violationsByMonth))
            }
        }).render();
    </script>
</div>
