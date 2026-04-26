<x-mail::layout>
    {{-- Header: Phần đầu thư có logo --}}
    <x-slot:header>
        <x-mail::header :url="config('app.url')">
            {{ config('app.name') }}
        </x-mail::header>
    </x-slot:header>

    {{-- Body: Nội dung chính của thư (Chào mừng, Đặt hàng...) --}}
    {{ $slot }}

    {{-- Subcopy: Phần chú thích nhỏ dưới nút bấm (nếu có) --}}
    @isset($subcopy)
        <x-slot:subcopy>
            <x-mail::subcopy>
                {{ $subcopy }}
            </x-mail::subcopy>
        </x-slot:subcopy>
    @endisset

    {{-- Footer: Phần chân thư ghi bản quyền --}}
    <x-slot:footer>
        <x-mail::footer>
            © Bản quyền {{ date('Y') }} bởi {{ config('app.name') }}.
        </x-mail::footer>
    </x-slot:footer>
</x-mail::layout>