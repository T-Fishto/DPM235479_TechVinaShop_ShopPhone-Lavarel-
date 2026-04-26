@props(['url'])
<tr>
    <td class="header">
        <a href="{{ $url }}" style="display:inline-block; text-decoration: none;">
            @if(file_exists(public_path('img/avatars/logo.png')))
                <img src="{{ asset('img/avatars/logo.png') }}"
                     class="logo" 
                     alt="{{ config('app.name') }}" 
                     height="50" 
                     style="max-height: 50px; width: auto;" />
            @else
                <span style="font-size: 24px; font-weight: bold; color: #d4af37;">{{ config('app.name', 'Tech VinaShop') }}</span>
            @endif
        </a>
    </td>
</tr>