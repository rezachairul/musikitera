@forelse ($users as $key => $user)
<tr class="hover:bg-gray-50 text-left text-xs">
    <!-- No -->
    <td class="px-6 py-4 whitespace-nowrap">
        {{ $users->firstItem() + $key }}
    </td>
    <!-- Name -->
    <td class="px-6 py-4 whitespace-nowrap">
        {{ $user->name }}
    </td>
    <!-- Email -->
    <td class="px-6 py-4 whitespace-nowrap">
        {{ $user->email }}
    </td>
    <!-- Role -->
    <td class="px-6 py-4 whitespace-nowrap">
        @php
            $roleInfo = $roleLabels[$user->role] ?? ['label' => ucfirst($user->role), 'color' => 'bg-gray-100 text-gray-700 border border-gray-300'];
        @endphp
         <span class="px-2 py-1 rounded-full text-xs font-medium {{ $roleInfo['color'] }}">
            {{ $roleInfo['label'] }}
        </span>
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center align-middle">
        @php
            $defaultEmails = [
                'admin.admin@ukmbsm.itera.ac.id',
                'bph.bph@ukmbsm.itera.ac.id',
                'dpo.dpo@ukmbsm.itera.ac.id',
                'pembina.pembina@ukmbsm.itera.ac.id'
            ];
        @endphp
        <div class="flex justify-center items-center h-full space-x-2">
            @if(in_array($user->email, $defaultEmails))
                <!-- Disabled Icon -->
                <div class="relative group text-red-800 cursor-not-allowed">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0-10.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.75c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.75h-.152c-3.196 0-6.1-1.25-8.25-3.286Zm0 13.036h.008v.008H12v-.008Z" />
                    </svg>
                    <!-- Tooltip -->
                    <div class="absolute -top-8 left-1/2 -translate-x-1/2 hidden group-hover:block bg-gray-700 text-white text-[10px] px-2 py-1 rounded shadow">
                        Akun default
                    </div>
                </div>
            @else
                <!-- Edit Button -->
                <button
                    onclick="openUpdateModal('{{ $user->id }}')"
                    class="text-amber-600 hover:text-amber-900 p-1 rounded hover:bg-amber-50" 
                    title="Edit">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" 
                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" 
                         class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                    </svg>
                </button>

                <!-- Delete Button -->
                <button
                    onclick="openDeleteModal('{{ $user->id }}')"
                    class="text-red-600 hover:text-red-900 p-1 rounded hover:bg-red-50"
                    title="Delete">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" 
                         viewBox="0 0 24 24" stroke-width="1.5" 
                         stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                    </svg>
                </button>
            @endif
        </div>
    </td>
</tr>
@empty
<tr class="hover:bg-gray-50">
    <td colspan="6" class="px-6 py-4 text-center text-gray-500 italic">
        <div class="flex flex-col items-center justify-center text-sm text-gray-500 space-y-1">
            @if ($users->isEmpty() && !request()->filled('search') && !request()->filled('filter'))
                <!-- Icon Data Kosong -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-400 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 9.75h4.5v4.5h-4.5v-4.5z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h18v18H3V3z" />
                </svg>
                <span class="text-blue-500 font-medium">Belum ada data yang tersedia di sini.</span>

            @elseif ($users->isEmpty() && request()->filled('search'))
                <!-- Icon Pencarian -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-400 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-4.35-4.35M10.5 17a6.5 6.5 0 100-13 6.5 6.5 0 000 13z" />
                </svg>
                <span class="text-yellow-600 font-medium">Tidak ditemukan hasil pencarian yang cocok.</span>

            @elseif ($users->isEmpty() && request()->filled('filter'))
                <!-- Icon Filter -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-400 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2l-7 8v5a1 1 0 01-2 0v-5l-7-8V4z" />
                </svg>
                <span class="text-red-500 font-medium">Data tidak tersedia untuk filter yang dipilih.</span>
            @endif
        </div>
    </td>
</tr>
@endforelse