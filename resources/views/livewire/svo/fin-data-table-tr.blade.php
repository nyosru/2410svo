<tr class="hover:bg-gray-100">
    <td class="p2-4 py-2 border border-t-1 border-t-gray-300">
        {{ $data1->vid ?? '-' }}<br />
        {{ $data1->firma ?? '-' }}
    </td>
    <td class="p2-4 py-2 border border-t-1 border-t-gray-300">
        {{ $data1->nom_schet ?? '-' }}<br />
        {{ $data1->naim_schet ?? '-' }}
    </td>
    <td class="p2-4 py-2 border border-t-1 border-t-gray-300">
        {{ $data1->zateya ?? '-' }}<br />
        {{ $data1->m_o_l ?? '-' }}
    </td>
    <td class="p2-4 py-2 border border-t-1 border-t-gray-300">
        {{ $data1->znachenie_dok ?? '-' }}<br />
        {{ $data1->nom_str ?? '-' }}
    </td>
    <td class="p2-4 py-2 border border-t-1 border-t-gray-300">
        {{ $data1->naimenovanie ?? '-' }}<br />
        {{ $data1->dobavka ?? '-' }}
    </td>
    <td class="p2-4 py-2 border border-t-1 border-t-gray-300">
        {{ $data1->koment ?? '-' }}<br />
        {{ $data1->dvizh ?? '-' }}
    </td>
    <td class="p2-4 py-2 border border-t-1 border-t-gray-300 text-right">
        {{ $data1->debet_nach <> 0 ? number_format($data1->debet_nach, 2, '.', '`') : '-' }}<br />
        {{ $data1->deb_kol_nach <> 0  ? number_format($data1->deb_kol_nach, 2, '.', '`') : '-' }}
    </td>
    <td class="p2-4 py-2 border border-t-1 border-t-gray-300 text-right">
        {{ $data1->kredit_nach <> 0  ? number_format($data1->kredit_nach, 2, '.', '`') : '-' }}<br />
        {{ $data1->kred_kol_nach <> 0  ? number_format($data1->kred_kol_nach, 2, '.', '`') : '-' }}
    </td>
    <td class="p2-4 py-2 border border-t-1 border-t-gray-300 text-right">
        {{ $data1->debet <> 0  ? number_format($data1->debet, 2, '.', '`') : '-' }}<br />
        {{ $data1->deb_kol <> 0  ? number_format($data1->deb_kol, 2, '.', '`') : '-' }}
    </td>
    <td class="p2-4 py-2 border border-t-1 border-t-gray-300 text-right">
        {{ $data1->kredit <> 0  ? number_format($data1->kredit, 2, '.', '`') : '-' }}<br />
        {{ $data1->kred_kol <> 0  ? number_format($data1->kred_kol, 2, '.', '`') : '-' }}
    </td>
    <td class="p2-4 py-2 border border-t-1 border-t-gray-300 text-right">
        {{ $data1->debet_kon <> 0  ? number_format($data1->debet_kon, 2, '.', '`') : '-' }}<br />
        {{ $data1->deb_kol_kon <> 0  ? number_format($data1->deb_kol_kon, 2, '.', '`') : '-' }}
    </td>
    <td class="p2-4 py-2 border border-t-1 border-t-gray-300 text-right">
        {{ $data1->kredit_kon <> 0  ? number_format($data1->kredit_kon, 2, '.', '`') : '-' }}<br />
        {{ $data1->kred_kol_kon <> 0  ? number_format($data1->kred_kol_kon, 2, '.', '`') : '-' }}
    </td>
{{--    <td class="p2-4 py-2 border border-t-1 border-t-gray-300">--}}
{{--        @if($data1->foto)--}}
{{--            <img src="{{ asset('storage/' . $data1->foto) }}" alt="Фото" class="max-h-16 mx-auto">--}}
{{--        @else--}}
{{--            ---}}
{{--        @endif--}}
{{--    </td>--}}
</tr>
