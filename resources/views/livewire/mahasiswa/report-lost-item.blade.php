<div>
    <div class="max-w-2xl mx-auto py-8">
        <div class="flex flex-col gap-6">

            {{-- Header --}}
            <div>
                <flux:heading size="xl">Lapor Kehilangan Barang</flux:heading>
                <flux:subheading>Isi formulir di bawah ini agar kami dan mahasiswa lain bisa membantu mencarinya.
                </flux:subheading>
            </div>

            <form wire:submit="save" class="space-y-6">

                {{-- Nama Barang --}}
                <flux:field>
                    <flux:label>Nama Barang</flux:label>
                    <flux:input wire:model="item_name" placeholder="Contoh: Dompet Kulit Coklat" />
                    <flux:error name="item_name" />
                </flux:field>

                {{-- Kategori --}}
                <flux:field>
                    <flux:label>Kategori</flux:label>
                    <flux:select wire:model="category_id" placeholder="Pilih Kategori">
                        @foreach ($categories as $cat)
                            <flux:select.option value="{{ $cat->id }}">{{ $cat->name }}</flux:select.option>
                        @endforeach
                    </flux:select>
                    <flux:error name="category_id" />
                </flux:field>

                {{-- Lokasi Hilang --}}
                <flux:field>
                    <flux:label>Perkiraan Lokasi Hilang</flux:label>
                    <flux:input wire:model="location" icon="map-pin" placeholder="Contoh: Kantin Teknik Lantai 1" />
                    <flux:error name="location" />
                </flux:field>

                {{-- Deskripsi/Ciri-ciri --}}
                <flux:field>
                    <flux:label>Ciri-ciri / Deskripsi</flux:label>
                    <flux:textarea wire:model="description" rows="4"
                        placeholder="Jelaskan ciri-ciri khusus, isi di dalamnya, dll." />
                    <flux:error name="description" />
                </flux:field>

                {{-- Upload Foto --}}
                <flux:field>
                    <flux:label>Foto Barang (Jika ada)</flux:label>
                    <div
                        class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl p-6 text-center hover:bg-gray-50 dark:hover:bg-gray-800 transition relative">
                        <input type="file" wire:model="photo"
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept="image/*">

                        @if ($photo)
                            <img src="{{ $photo->temporaryUrl() }}" class="mx-auto h-40 object-cover rounded-lg">
                            <p class="mt-2 text-xs text-green-600 font-bold">Foto terpilih</p>
                        @else
                            <flux:icon name="photo" class="w-10 h-10 mx-auto text-gray-400 mb-2" />
                            <p class="text-sm text-gray-500">Klik untuk upload foto</p>
                            <p class="text-xs text-gray-400">JPG, PNG (Max 2MB)</p>
                        @endif
                    </div>
                    <flux:error name="photo" />
                </flux:field>

                <div class="flex justify-end gap-3 pt-4">
                    <flux:button href="{{ route('dashboard') }}" variant="ghost">Batal</flux:button>
                    <flux:button type="submit" variant="primary">Kirim Laporan</flux:button>
                </div>

            </form>
        </div>
    </div>
</div>
