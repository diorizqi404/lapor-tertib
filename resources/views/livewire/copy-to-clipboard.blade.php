<div class="flex items-center space-x-2 bg-green-400/75 rounded-sm m-1">
    <!-- Tombol Copy -->
    <button class="border-r px-1 py-1 border-green-50"
        onclick="copyToClipboard('{{ $text }}', this)">
        <span class="icon">
            <!-- SVG Icon Copy -->
            <x-heroicon-o-clipboard class="w-5 h-5 copy-icon text-green-800" />
            <!-- SVG Icon Check (Hidden by Default) -->
            <x-heroicon-o-clipboard-document-check class="w-5 h-5 hidden check-icon text-green-800" />
        </span>
    </button>

    <!-- Teks yang Bisa Diklik untuk Disalin -->
    <div class="cursor-pointer font-mono pr-2"
        onclick="copyToClipboard('{{ $text }}', this.previousElementSibling)">
        {{ $text }}
    </div>
</div>

<script>
    function copyToClipboard(text, button) {
        navigator.clipboard.writeText(text).then(() => {
            let copyIcon = button.querySelector('.copy-icon');
            let checkIcon = button.querySelector('.check-icon');

            // Sembunyikan ikon copy, tampilkan ikon centang
            copyIcon.classList.add('hidden');
            checkIcon.classList.remove('hidden');

            setTimeout(() => {
                // Kembalikan ikon copy setelah 4 detik
                copyIcon.classList.remove('hidden');
                checkIcon.classList.add('hidden');
            }, 2500);
        }).catch(err => console.error('Failed to copy text:', err));
    }
</script>
