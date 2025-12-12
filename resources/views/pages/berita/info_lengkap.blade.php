@extends('app')

@section('title', 'Bebras Indonesia Challenge ' . date('Y'))

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-10">

        {{-- Banner --}}
        <div class="w-full mb-10">
            <img src="https://bebras.or.id/v3/wp-content/uploads/2025/10/Banner-Website-Bebras-2025-2-1024x411.jpg"
                alt="Bebras Challenge Banner" class="w-full h-auto rounded-xl shadow-md object-cover">
        </div>

        {{-- Layout 8:2 --}}
        <div class="grid grid-cols-1 lg:grid-cols-10 gap-8">

            {{-- Konten Utama (8 kolom) --}}
            <div class="lg:col-span-8">
                <h1 class="text-3xl md:text-4xl font-bold mb-6 text-gray-800">
                    Bebras Indonesia Challenge {{ date('Y') }}
                </h1>

                <p class="text-gray-700 leading-relaxed mb-6">
                    Selamat datang di halaman resmi Bebras Indonesia Challenge {{ date('Y') }}.
                    Silakan cek jadwal, informasi poster, dan pengumuman terbaru melalui sidebar.
                </p>

                {{-- Isi konten --}}
                <div class="entry-content">

                    <div class="prose prose-lg max-w-none text-gray-800">

                        {{-- Subjudul --}}
                        <h2 class="text-2xl md:text-3xl font-semibold mt-8">
                            Pedoman Tantangan Bebras Indonesia 2025
                        </h2>

                        {{-- Hashtag --}}
                        <p class="text-bebrasBlue font-medium">
                            #berprestasidarirumah #jujuritukeren #jujuritubermartabat
                        </p>

                        {{-- Daftar Navigasi --}}
                        <div class="bg-gray-50 border border-gray-200 rounded-xl p-6 mt-6 shadow-sm">
                            <h3 class="text-xl font-semibold mb-3">Navigasi Cepat</h3>
                            <ul class="grid grid-cols-1 md:grid-cols-2 gap-2 text-blue-600 font-medium">
                                <li><a href="#alokasi">Alokasi waktu dan jumlah soal</a></li>
                                <li><a href="#jenissoal">Jenis soal Tantangan Bebras</a></li>
                                <li><a href="#jadwal">Jadwal Tantangan Bebras 2025</a></li>
                                <li><a href="#pendaftaran">Pendaftaran peserta</a></li>
                                <li><a href="#mekanisme">Mekanisme pendaftaran</a></li>
                                <li><a href="#pengumuman">Pengumuman hasil</a></li>
                                <li><a href="#sertifikat">Sertifikat</a></li>
                                <li><a href="#peran">Peran pihak yang terlibat</a></li>
                                <li><a href="#prosedur">Prosedur penanganan masalah</a></li>
                                <li><a href="#faq">Tanya jawab</a></li>
                                <li><a href="#pakta">Pakta Integritas</a></li>
                            </ul>
                        </div>

                        {{-- Deskripsi Awal --}}
                        <p class="mt-8 leading-relaxed">
                            Tantangan Bebras atau <strong>Bebras Computational Thinking Challenge</strong> adalah ajang
                            yang dilaksanakan <strong>setahun sekali</strong> pada pekan Bebras (<em>Bebras Week</em>)
                            di
                            seluruh dunia oleh komunitas Bebras Internasional.
                        </p>

                        <p class="leading-relaxed">
                            Tantangan Bebras Indonesia merupakan kesempatan bagi siswa Indonesia untuk menunjukkan
                            kemampuan <em>Computational Thinking</em> secara sukarela, mandiri, menyenangkan, penuh
                            kejujuran, dan kegembiraan bersama siswa lain di seluruh dunia.
                        </p>

                        <p class="leading-relaxed">
                            Tantangan Bebras 2025 akan diselenggarakan secara online melalui situs:
                            <a href="https://tantanganbebras.ipb.ac.id" class="text-blue-600 underline">
                                https://tantanganbebras.ipb.ac.id
                            </a>, yang dapat diikuti dari mana saja.
                        </p>

                        <p class="leading-relaxed font-medium">
                            Jadwal pelaksanaan: <strong>10 November – 15 November 2025</strong>
                            <br>#berprestasidarirumah #jujuritukeren #jujuritubermartabat
                        </p>

                        {{-- Lokasi Pelaksanaan --}}
                        <h2 class="text-2xl font-semibold mt-10">Lokasi Pelaksanaan Tantangan Bebras 2025</h2>

                        <ul class="list-disc ml-6 space-y-2">
                            <li>Sekolah yang sudah menjalankan pembelajaran tatap muka, dengan mematuhi protokol
                                kesehatan.
                            </li>
                            <li>Kampus atau lokasi yang ditentukan Biro Bebras Koordinator Sekolah.</li>
                            <li>Rumah masing-masing dengan pengawasan orang tua, menjaga kejujuran dan integritas,
                                serta persetujuan Panitia Biro Bebras dan Panitia Pusat.
                                <br>
                                <span class="text-gray-600 text-sm">
                                    (Opsi terakhir jika pembelajaran tatap muka tidak memungkinkan)
                                </span>
                            </li>
                        </ul>

                        {{-- Alokasi Waktu --}}
                        <h2 id="alokasi" class="text-2xl font-semibold mt-12">
                            Alokasi Waktu dan Jumlah Soal
                        </h2>

                        <p>
                            Waktu yang dibutuhkan untuk mengikuti Tantangan Bebras terdapat pada tabel berikut:
                        </p>

                    </div>

                    <div class="overflow-x-auto mt-6">
                        <table class="min-w-full border border-gray-300 rounded-lg overflow-hidden text-sm">
                            <thead>
                                <tr class="bg-yellow-300 text-gray-900">
                                    <th class="px-4 py-3 text-left"></th>
                                    <th class="px-4 py-3 text-left">Dilaksanakan dalam 1 Sesi (120 menit)</th>
                                    <th class="px-4 py-3 text-left">Dibuka sepanjang Pekan Bebras</th>
                                </tr>
                                <tr class="bg-yellow-300 font-semibold text-gray-900">
                                    <th class="px-4 py-3 text-left">Kategori</th>
                                    <th class="px-4 py-3 text-left">Tantangan 1x Kesempatan</th>
                                    <th class="px-4 py-3 text-left">Coba-Akun (3x Kesempatan)</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200">

                                <tr>
                                    <td class="px-4 py-4 font-semibold">
                                        SiKecil
                                        <div class="text-gray-600 font-normal text-sm">
                                            SD/MI (setara kelas 1–3)
                                        </div>
                                    </td>
                                    <td class="px-4 py-4">30 menit (8 soal)</td>
                                    <td class="px-4 py-4">20 menit (3 soal)</td>
                                </tr>

                                <tr>
                                    <td class="px-4 py-4 font-semibold">
                                        Siaga
                                        <div class="text-gray-600 font-normal text-sm">
                                            SD/MI (setara kelas 4–6)
                                        </div>
                                    </td>
                                    <td class="px-4 py-4">40 menit (12 soal)</td>
                                    <td class="px-4 py-4">20 menit (4 soal)</td>
                                </tr>

                                <tr>
                                    <td class="px-4 py-4 font-semibold">
                                        Penggalang
                                        <div class="text-gray-600 font-normal text-sm">
                                            SMP/MTs (setara kelas 7–9)
                                        </div>
                                    </td>
                                    <td class="px-4 py-4">45 menit (15 soal)</td>
                                    <td class="px-4 py-4">20 menit (5 soal)</td>
                                </tr>

                                <tr>
                                    <td class="px-4 py-4 font-semibold">
                                        Penegak
                                        <div class="text-gray-600 font-normal text-sm">
                                            SMA/SMK/MA/MAK (setara kelas 10–12)
                                        </div>
                                    </td>
                                    <td class="px-4 py-4">45 menit (15 soal)</td>
                                    <td class="px-4 py-4">20 menit (6 soal)</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                    <div class="space-y-6">

                        <p class="font-semibold text-gray-800">Keterangan:</p>

                        <ol class="list-decimal list-inside space-y-3 text-gray-700 leading-relaxed">
                            <li>
                                Waktu pengerjaan dihitung sejak peserta menekan tombol <strong>“Attempt”</strong>.
                                Peserta tetap mendapatkan durasi penuh meskipun tidak memulai secara bersamaan.
                            </li>

                            <li>
                                Skor pada sertifikat ditentukan dari kebenaran jawaban selama Tantangan Bebras.
                            </li>

                            <li>
                                Untuk persiapan mental dan pengecekan akun, peserta diberi kesempatan mengikuti sesi
                                <strong>Coba-Akun</strong>, berlangsung pada <strong>9–10 November 2025</strong>.
                            </li>

                            <li>
                                Peserta hanya dapat mengikuti tantangan pada hari & jam sesuai kategori masing-masing.
                            </li>

                            <li>
                                Selama tantangan berlangsung tidak ada sesi tanya jawab terkait soal. Guru Koordinator
                                dapat menyampaikan masukan melalui Koordinator Biro Bebras untuk diteruskan ke Panitia
                                Pusat.
                            </li>

                            <li>
                                Kategori menentukan tingkat kesulitan soal. Peserta boleh naik/turun kategori sesuai
                                arahan guru dan Biro Bebras.
                            </li>
                        </ol>
                    </div>

                    <div class="mt-10">
                        <h3 id="jenissoal" class="text-2xl font-bold mb-4 text-gray-800">
                            Jenis Soal Tantangan Bebras
                        </h3>

                        <div class="overflow-x-auto">
                            <table class="min-w-full border border-gray-300 rounded-lg text-sm">
                                <thead class="bg-yellow-300 text-gray-900">
                                    <tr>
                                        <th class="px-4 py-3 text-center font-semibold">Jenis Soal</th>
                                        <th class="px-4 py-3 text-center font-semibold">Keterangan</th>
                                    </tr>
                                </thead>

                                <tbody class="divide-y divide-gray-200">

                                    <tr>
                                        <td class="px-4 py-4 font-medium">
                                            <em>Multiple Choice</em> / Pilihan Ganda
                                        </td>
                                        <td class="px-4 py-4">
                                            Jawaban dapat berupa satu atau lebih pilihan.
                                            Jika jawaban salah, ada penalti sesuai jumlah pilihan yang tersedia.
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="px-4 py-4 font-medium">
                                            <em>Short Answer</em> / Isian Singkat
                                        </td>
                                        <td class="px-4 py-4">
                                            Jika jawaban salah, tidak ada pengurangan skor.
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="px-4 py-4 font-medium">
                                            <em>Matching</em> / Mencocokkan
                                        </td>
                                        <td class="px-4 py-4">
                                            Jika jawaban salah, tidak ada pengurangan skor.
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="mt-10">
                        <h3 id="jadwal" class="text-2xl font-bold text-gray-800 mb-4">
                            Jadwal Tantangan Bebras {{ date('Y') }}
                        </h3>

                        <p class="text-gray-700 mb-6 leading-relaxed">
                            Tantangan Bebras {{ date('Y') }} diadakan sesuai dengan jadwal pekan Bebras,
                            yaitu mulai tanggal <span class="font-semibold">10 November</span> s.d.
                            <span class="font-semibold">15 November {{ date('Y') }}</span>.
                            Pelaksanaannya diatur sesuai tabel sebagai berikut:
                        </p>

                        <div class="overflow-x-auto bg-white shadow-md rounded-xl">
                            <table class="min-w-full border-collapse">
                                <thead>
                                    <tr class="bg-yellow-300 text-gray-900">
                                        <th class="py-3 px-4 text-center font-semibold">Hari, Tanggal</th>
                                        <th class="py-3 px-4 text-center font-semibold">Kategori</th>
                                        <th class="py-3 px-4 text-center font-semibold">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-700">

                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="py-3 px-4">S.d. 3 November {{ date('Y') }}</td>
                                        <td class="py-3 px-4">Semua Kategori</td>
                                        <td class="py-3 px-4">Pendaftaran</td>
                                    </tr>

                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="py-3 px-4">Minggu–Senin, 9–10 November {{ date('Y') }}</td>
                                        <td class="py-3 px-4">Semua Kategori</td>
                                        <td class="py-3 px-4">Coba Akun</td>
                                    </tr>

                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="py-3 px-4">Selasa, 11 November {{ date('Y') }}</td>
                                        <td class="py-3 px-4">Penegak</td>
                                        <td class="py-3 px-4">Tingkat kesulitan kelas 10–12</td>
                                    </tr>

                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="py-3 px-4">Rabu, 12 November {{ date('Y') }}</td>
                                        <td class="py-3 px-4">Penggalang</td>
                                        <td class="py-3 px-4">Tingkat kesulitan kelas 7–9</td>
                                    </tr>

                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="py-3 px-4">Kamis, 13 November {{ date('Y') }}</td>
                                        <td class="py-3 px-4">Siaga</td>
                                        <td class="py-3 px-4">Tingkat kesulitan kelas 4–6</td>
                                    </tr>

                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="py-3 px-4">Jumat, 14 November {{ date('Y') }}</td>
                                        <td class="py-3 px-4">SiKecil</td>
                                        <td class="py-3 px-4">Tingkat kesulitan kelas 1–3</td>
                                    </tr>

                                    <tr class="hover:bg-gray-50">
                                        <td class="py-3 px-4">Sabtu, 15 November {{ date('Y') }}</td>
                                        <td class="py-3 px-4">Semua Kategori</td>
                                        <td class="py-3 px-4">Sekolah khusus dengan peserta lebih dari 3000</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="mt-2">

                        <!-- Jadwal -->
                        <section class="p-6 bg-white shadow rounded-xl space-y-4">
                            <h3 class="text-2xl font-bold text-bebrasRed">
                                Jadwal Tantangan Bebras {{ date('Y') }}
                            </h3>

                            <p>
                                Tantangan Bebras {{ date('Y') }} dibuka dengan jadwal sebagai berikut
                                <span class="font-semibold">(perhatikan waktu dalam WIB):</span>
                            </p>

                            <!-- Hari Umum -->
                            <div class="space-y-1">
                                <p class="font-semibold">Senin s.d. Kamis dan Sabtu:</p>
                                <ul class="list-disc ml-6 text-gray-700">
                                    <li>Pukul 07.00 – 18.15 WIB (9 slot)</li>
                                </ul>
                            </div>

                            <!-- Jumat -->
                            <div class="space-y-1">
                                <p class="font-semibold">Hari Jumat:</p>
                                <ul class="list-disc ml-6 text-gray-700">
                                    <li>Pukul 07.00 – 10.45 WIB (3 slot)</li>
                                    <li>Pukul 13.15 – 18.15 WIB (4 slot)</li>
                                </ul>
                            </div>

                            <!-- Sesi -->
                            <p class="font-semibold mt-4">Pembagian Slot/Sesi Setiap Hari (WIB):</p>

                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                                @foreach ([['A', '07.00 – 08.15'], ['B', '08.15 – 09.30'], ['C', '09.30 – 10.45'], ['D', '10.45 – 12.00'], ['E', '12.00 – 13.15'], ['F', '13.15 – 14.30'], ['G', '14.30 – 15.45'], ['H', '15.45 – 17.00'], ['I', '17.00 – 18.15']] as $sesi)
                                    <div class="border p-3 rounded-lg bg-gray-50">
                                        <span class="font-semibold">Sesi {{ $sesi[0] }}:</span>
                                        <span>{{ $sesi[1] }} WIB</span>
                                    </div>
                                @endforeach
                            </div>

                            <p class="mt-4">
                                Siswa mengikuti tantangan sesuai jadwal yang dipilih saat pendaftaran.
                                Perhatikan <span class="font-semibold">Butir 4 pada Mekanisme Pendaftaran</span>.
                            </p>
                        </section>

                        <!-- Pendaftaran -->
                        <section id="pendaftaran" class="p-6 bg-white shadow rounded-xl space-y-4">
                            <h3 class="text-2xl font-bold text-bebrasRed">Pendaftaran Peserta</h3>

                            <p>
                                Seluruh proses <strong>pendaftaran dilakukan melalui sekolah</strong>. Setiap sekolah
                                berinduk
                                pada satu Biro Bebras. Daftar Biro dan <em>Contact Person</em> tersedia di:
                                <a href="https://bebras.or.id/v3/bebras-biro/" class="text-blue-600 hover:underline">
                                    https://bebras.or.id/v3/bebras-biro/
                                </a>
                            </p>

                            <p>Guru yang belum pernah mengikuti pelatihan dapat langsung menghubungi Biro.</p>

                            <p>
                                Peserta <em>homeschooling</em> dapat mendaftar melalui Biro yang bersedia menerima
                                peserta,
                                kemudian Biro akan menentukan sesi bersama sekolah terkait.
                            </p>

                            <p>
                                Biro disarankan membentuk Panitia Pelaksana untuk mengelola pendaftaran dan koordinasi
                                dengan
                                Panitia Pusat.
                            </p>

                            <p>
                                Panitia Pusat Tantangan Bebras {{ date('Y') }}
                                <strong>hanya menerima pendaftaran melalui Biro</strong>.
                                Tidak menerima pendaftaran individu atau langsung dari sekolah.
                            </p>
                        </section>

                        <!-- Mekanisme -->
                        <section id="mekanisme" class="p-6 bg-white shadow rounded-xl space-y-4 mt-2">
                            <h3 class="text-2xl font-bold text-bebrasRed">Mekanisme Pendaftaran</h3>

                            <ol class="list-decimal ml-6 space-y-2">
                                <li>Sekolah mengisi daftar siswa pada template file (Excel).</li>
                                <li>Sekolah mengirim file ke Biro untuk direkap.</li>
                                <li>
                                    Biro mengunggah file peserta ke situs registrasi paling lambat
                                    <strong>3 November {{ date('Y') }} pukul 23:59</strong> di
                                    <a href="https://registrasi-tantanganbebras.ipb.ac.id"
                                        class="text-blue-600 hover:underline">
                                        https://registrasi-tantanganbebras.ipb.ac.id
                                    </a>
                                </li>
                                <li>
                                    Peserta hanya boleh mendaftar pada satu Biro, memilih satu kategori
                                    (SiKecil, Siaga, Penegak, Penggalang), dan satu bahasa (Indonesia/Inggris).
                                </li>
                                <li>Pendaftaran tidak dipungut b


                                    <h3 id="mekanisme"><strong>Pra Tantangan</strong></h3>
                                    <ol>
                                        <li>Setiap peserta diharapkan mencoba untuk mengakses situs tantangan di <a
                                                href="https://tantanganbebras.ipb.ac.id">https://tantanganbebras.ipb.ac.id</a>
                                            untuk mencoba akun dan berlatih kecil sebelum jadwal tantangan pada hari 9 –
                                            10 November 2025.</li>
                                        <li>Coba Akun/Latihan di situs tantangan diberikan 3 kali kesempatan (attempt)
                                        </li>
                                        <li>Peserta diharapkan mempersiapkan perangkat dan koneksi internet yang cukup
                                            baik saat lomba untuk menghindari kesulitan saat lomba (mis: batere
                                            laptop/hp penuh, koneksi tidak putus, dll)</li>
                                    </ol>
                                    <h3 id="mekanisme"><strong>Saat Tantangan</strong></h3>
                                    <ol>
                                        <li>Setiap peserta mengikuti tantangan sesuai dengan <strong>jadwal</strong>
                                            yang telah ditentukan sesuai dengan <strong>kategori</strong> (SiKecil,
                                            Siaga, Penggalang, Penegak) dan <strong>bahasa</strong> ( bahasa Indonesia
                                            atau bahasa Inggris)</li>
                                        <li>Tantangan hanya diperbolehkan 1 kali kesempatan (<em>attempt</em>)</li>
                                        <li>Persiapkan Kertas dan Pensil</li>
                                        <li>Tantangan dapat dilaksanakan secara luring</li>
                                        <li>Jika ada gangguan, guru dapat melaporkan gangguan tersebut ke Biro Bebras
                                            yang menaunginya, yang selanjutnya akan ditangani secara terpisah</li>
                                    </ol>
                                    <h3>&nbsp;</h3>
                                    <h3 id="pengumuman"><strong>Pengumuman Hasil</strong></h3>
                                    <ul>
                                        <li>&nbsp;Hasil Tantangan Bebras akan dipublikasi setelah semua
                                            keluhan/permasalahan selesai ditangani dan data diproses.</li>
                                        <li>Hasil Tantangan dipublikasi di laman <a
                                                href="http://bebras.or.id">http://bebras.or.id</a></li>
                                        <li>National Board Organization (NBO) Bebras akan memberikan sertifikat kepada
                                            semua peserta</li>
                                        <li>Bebras Biro dapat memberikan penghargaan kepada peserta dengan kriteria yang
                                            ditetapkan</li>
                                    </ul>
                                    <h3>&nbsp;</h3>
                                    <h3 id="sertifikat"><strong>Sertifikat</strong></h3>
                                    <p>Ada 2 jenis sertifikat:<br>a) Sertifikat dengan mencantumkan nilai tantangan
                                        (jika nilai &gt;= 50)<br>b) Sertifikat tanda keikutsertaan, yang tidak
                                        mencantumkan nilai tantangan ( nilai &lt; 50)</p>
                                    <ul>
                                        <li>Sertifikat akan dikirim dalam bentuk <em>e-certificate</em> ke peserta.</li>
                                    </ul>
                                    <p>Catatan : untuk menghindari salah nama atau data lain pada sertifikat, hendaknya
                                        guru mencermati data pendaftaran dengan teliti. Biro dan Panitia Pusat tidak
                                        bertanggung jawab untuk kesalahan data setelah sertifikat dicetak.</p>
                                    <h3>&nbsp;</h3>
                                    <h3 id="peran"><strong>Peran Pihak yang terlibat</strong></h3>
                                    <dl>
                                        <dt>Tim Teknis <em>Server</em></dt>
                                        <dd>Menyediakan <em>platform</em>, <em>server</em> dan pengoperasioan Tantangan
                                            Bebras secara online, dan sistem registrasi online. Bekerja sama dengan
                                            Panitia Pusat untuk penyelenggaraan Tantangan Bebras</dd>
                                        <dt>Panitia Pusat (NBO)</dt>
                                        <dd>Menyiapkan soal Tantangan Bebras dan membantu Tim Teknis <em>Server</em>
                                            untuk menjawab pertanyaan serta menganalisis masalah.</dd>
                                        <dt>Dewan Juri</dt>
                                        <dd>Panitia Pusat dan Tim Teknis akan membuat keputusan terhadap masalah teknis
                                            selama pelaksanaan Tantangan Bebras, dan mengumumkan tindak lanjutnya.</dd>
                                        <dt>Panitia Bebras Biro</dt>
                                        <dd>Berkoordinasi dengan Guru Koordinator Sekolah, untuk penyelenggaraan
                                            Tantangan Bebras, dan merupakan <em>liaison</em> (penghubung) sekolah dengan
                                            Panitia Pusat. Panitia Bebras Biro diketuai oleh seorang Koordinator, dan
                                            dapat mengangkat Wakil serta anggota pelaksana sesuai dengan kebutuhan Biro.
                                            Panitia Pusat hanya berhubungan dengan Koordinator Panitia Bebras Biro.
                                            Untuk mempersingkat penulisan, Panitia Bebras Biro selanjutnya disebut
                                            sebagai Panitia Biro</dd>
                                        <dt>Guru Koordinator</dt>
                                        <dd>Guru yang ditunjuk oleh Sekolah untuk melakukan persiapan (registrasi
                                            peserta), pengawasan selama pelaksanaan Tantangan Bebras dan sesudahnya
                                            (pembagian sertifikat). Guru Koordinator boleh menunjuk seorang wakil
                                            koordinator. Panitia Biro bebras hanya akan berhubungan dengan Guru
                                            Koordinator.</dd>
                                        <dt>Guru pengawas</dt>
                                        <dd>Guru yang ditunjuk oleh Sekolah untuk mengawasi siswa selama mengerjakan
                                            Tantangan Bebras dan memberikan bantuan teknis kesulitan login, atau
                                            lainnya. Guru pengawas melapor ke guru Koordinator jika perlu.</dd>
                                        <dt>Orang Tua/Pendamping</dt>
                                        <dd>Khusus untuk siKecil dan Siaga, untuk pelaksanaan Tantangan Online di rumah,
                                            orang tua/pendamping diharapkan menjadi pendamping siKecil, membantu login
                                            dan menyiapkan komputer/HP sampai siap dipakai menjawab Tantangan Bebras
                                            serta membantu kesulitan teknis penggunaan perangkat jika ada.<p></p>
                                            <p>Khusus untuk siKecil, orang tua/pendamping boleh membacakan (bukan
                                                menjelaskan) soal jika siswa belum dapat membaca. Jika dilakukan di
                                                rumah, Orang tua/pendamping TIDAK DIPERKENANKAN membantu siswa menjawab
                                                soal atau menjelaskan soal. <strong>Orang tua hanya boleh membacakan
                                                    soal dan menjelaskan istilah/kata yang tidak dipahami
                                                    siswa</strong>.</p>
                                            <p>Orang tua boleh menunjuk kakak atau wali lain sebagai pendamping.</p>
                                        </dd>
                                    </dl>
                                    <h3 id="prosedur"><strong>Prosedur Penanganan Masalah</strong></h3>
                                    <p>Pada prinsipnya, Panitia Biro akan menerima semua keluhan/persoalan/permasalahan,
                                        dan akan merekamnya. Panitia Pusat, Tim Teknis, dan Panitia Biro akan mengkaji,
                                        menganalisis dan mempelajari keluhan serta bukti yang disertakan, untuk
                                        menentukan tindak lanjutnya. Keputusan Panitia dibuat seadil-adilnya,dan tidak
                                        dapat diganggu gugat. Persoalan yang dapat diselesaikan di tingkat Biro
                                        sebaiknya tetap direkam dan statusnya diselesaikan oleh Panitia Biro. Perekaman
                                        kasus akan berguna untuk bahan belajar, dan pelaksanaan yang lebih baik di masa
                                        y.a.d</p>
                                    <p>Berikut ini diberikan kategori permasalahan dan penanganannya (jika
                                        diakomodir).<br>Masalah lain di luar yang dituliskan pada tabel ini dapat
                                        dilaporkan melalui Panitia Biro Bebras ke Panitia Pusat.</p>
                                    <div class="overflow-x-auto rounded-lg shadow">
                                        <table class="w-full border border-gray-300">
                                            <thead>
                                                <tr class="bg-yellow-300 text-gray-900">
                                                    <th class="w-1/3 p-3 text-left font-semibold">Masalah dan akibatnya
                                                    </th>
                                                    <th class="w-2/3 p-3 text-left font-semibold">Penanganan dan Tindak
                                                        Lanjut</th>
                                                </tr>
                                            </thead>

                                            <tbody class="divide-y divide-gray-200">

                                                <tr>
                                                    <td class="p-4 align-top">
                                                        Listrik mati dan siswa terhenti saat mengerjakan tantangan. Padahal
                                                        tantangan hanya boleh diakses
                                                        (<em>attempt</em>) satu kali saja.
                                                    </td>
                                                    <td class="p-4 align-top">
                                                        Jika saat listrik hidup masih dapat melanjutkan (masih dalam waktu
                                                        lomba), maka OK.
                                                        <p class="mt-2">
                                                            Jika saat listrik hidup kembali sesi sudah habis, mohon
                                                            melaporkan ke Koordinator Biro
                                                            disertai bukti bahwa listrik mati, agar anak mendapat kesempatan
                                                            ulang pada sesi Susulan.
                                                            Lamanya listrik mati akan menjadi pertimbangan.
                                                        </p>
                                                        <p class="font-semibold mt-3">Sebagai antisipasi:</p>
                                                        <ul class="list-disc pl-5">
                                                            <li>Lomba di lokasi yang aman jika listrik mati (ada generator).
                                                            </li>
                                                            <li><em>Charge</em> laptop/HP penuh & sediakan baterai cadangan.
                                                            </li>
                                                        </ul>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="p-4 align-top">
                                                        Internet terputus-putus saat mengerjakan tantangan.
                                                    </td>
                                                    <td class="p-4 align-top">
                                                        Pada umumnya bisa melanjutkan, walau kehilangan waktu.
                                                        <p class="mt-2">
                                                            Panitia tidak memberikan pengecualian, kecuali gangguan massal
                                                            di media massa.
                                                        </p>
                                                        <p class="mt-2">Disarankan memiliki koneksi internet cadangan.
                                                        </p>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="p-4 align-top">
                                                        Laptop atau HP peserta terganggu (mati, restart, auto-update,
                                                        rusak).
                                                    </td>
                                                    <td class="p-4 align-top">
                                                        Peserta tetap bisa melanjutkan, tetapi waktu yang hilang tidak
                                                        diganti.
                                                        <p class="mt-2"><strong>Tindakan pencegahan:</strong></p>
                                                        <ul class="list-disc pl-5">
                                                            <li>Pastikan baterai cukup / dekat sumber listrik.</li>
                                                            <li>Nonaktifkan auto-restart & auto-update.</li>
                                                            <li>Siapkan perangkat cadangan.</li>
                                                        </ul>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="p-4 align-top">
                                                        Soal terasa aneh, kalimat tidak dipahami, atau jawaban tidak ada
                                                        yang benar.
                                                    </td>
                                                    <td class="p-4 align-top">
                                                        Mohon guru melaporkan ke Koordinator Biro untuk diteruskan ke
                                                        Panitia Pusat.
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="p-4 align-top">
                                                        Soal tidak bisa dilanjutkan / tombol <em>next</em> tidak dapat
                                                        ditekan.
                                                    </td>
                                                    <td class="p-4 align-top">
                                                        Tekan F5 untuk <em>refresh page</em>.
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="p-4 align-top">
                                                        Ada kendala teknis dari listrik atau internet peserta.<br>
                                                        Apakah pengerjaan soal diulang dari awal?
                                                    </td>
                                                    <td class="p-4 align-top">
                                                        Tidak. Jawaban otomatis tersimpan setiap 1–2 menit.
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="p-4 align-top">
                                                        Tidak sempat menekan “FINISH” waktu habis.
                                                    </td>
                                                    <td class="p-4 align-top">
                                                        Ya, sistem otomatis menyimpan jawaban terakhir.
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="p-4 align-top">
                                                        Selesai mengerjakan sebelum waktu habis — apakah boleh FINISH?
                                                    </td>
                                                    <td class="p-4 align-top">
                                                        Anda dapat:
                                                        <ul class="list-disc pl-5 mt-1">
                                                            <li>Memeriksa jawaban kembali</li>
                                                            <li>FINISH dan selesai</li>
                                                        </ul>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>

                                    <p class="mt-1">Catatan : beberapa biro membuat aturan pemberian <em>award</em>
                                        berdasarkan waktu
                                        (jika skor sama) atau aturan lain yang diberlakukan hanya untuk bironya, NBO
                                        tidak menetapkan waktu singkat sebagai kriteria.</p>
                                    <p></p>
                                    <h3 id="faq"><strong>Tanya Jawab</strong></h3>
                                    <ol>
                                        <li>Apakah situs yang dipakai untuk tantangan bebras sama dengan situs yang
                                            selama ini dipakai untuk latihan ? JAWAB: TIDAK.
                                            <ul type="a">
                                                <li>Platform latihan diakses di <a
                                                        href="https://latihan.bebras.or.id/">https://latihan.bebras.or.id</a>
                                                    berbeda dengan Platform Tantangan yang diakses di
                                                    https://tantanganbebras.ipb.ac.id dan sengaja dibuat terpisah.</li>
                                                <li>Walaupun platform nya berbeda, tampilan dan antarmuka interaksi
                                                    dengan sistem sama sehingga seharusnya peserta yang sudah pernah
                                                    berlatih di platform latihan akan sudah terbiasa serta tidak
                                                    canggung berinteraksi dengan sistem</li>
                                            </ul>
                                        </li>
                                        <li>Bagaimana memperoleh akun di platform Latihan ?
                                            <ul type="a">
                                                <li>Kunjungi situs <a
                                                        href="https://latihan.bebras.or.id/">https://latihan.bebras.or.id</a>.
                                                    Di laman tersebut, ada panduan pembuatan akun dalam bentuk file PDF
                                                    yang dapat diunduh.</li>
                                                <li>User mendaftarkan diri melalui fasilitas “Create New Account”,
                                                    mendapatkan konfirmasi email, dan melakukan “Enroll” pada latihan
                                                    yang tersedia. Pilihlah Latihan yang sesuai dengan Kategori yang
                                                    akan dipilih. Pada Latihan, siswa dapat memilih semua kategori. Jika
                                                    menjumpai kesulitan, ada baiknya untuk memulai latihan kategori
                                                    lebih rendah (misalnya akan mengikuti Penggalang, mulai latihan
                                                    Siaga sebelum mengerjakan Penggalang.)</li>
                                                <li>Karena ada batasan usia untuk mempunyai akun email, maka bagi siswa
                                                    SD, akun dapat dibuatkan dan dikelola oleh orangtua, wali atau guru.
                                                </li>
                                            </ul>
                                        </li>
                                        <li>Apakah saya harus membuat akun (username dan password) untuk ikut tantangan
                                            bebras? JAWAB: TIDAK
                                            <ul type="a">
                                                <li>User-id dan password untuk tantangan bebras berbeda dengan user-id
                                                    dan password yang dibuat sendiri (atau diberikan oleh guru) dalam
                                                    rangka mencoba soal-soal di platform <a
                                                        href="https://latihan.bebras.or.id/">https://latihan.bebras.or.id</a>.
                                                </li>
                                                <li>Akun tantangan akan dibuatkan oleh sistem dan hanya dapat dipakai
                                                    saat Coba-Akun dan Tantangan Bebras. Setelah itu, akun tidak bisa
                                                    dipakai lagi, kecuali untuk masalah yang setelah ditinjau diputuskan
                                                    oleh Dewan Juri.</li>
                                                <li>User-id dan password akan diberikan oleh guru sekolah kepada
                                                    siswanya. Guru sekolah mengetahui user-id dan password peserta yang
                                                    dibinanya.</li>
                                                <li>Guru dan siswa peserta wajib menjaga kerahasiaan password, dan
                                                    menyatakan “OK” pada laman persetujuan, bahwa tidak akan memberikan
                                                    password tersebut kepada orang yang tidak berhak.</li>
                                                <li>Khusus untuk akun SiKecil dan SD, guru memberitahukan ke orang tua
                                                    atau wali peserta yang ditunjuk dan disetujui oleh guru. Orang tua
                                                    peserta dan wali juga wajib menjaga kerahasiaan password anaknya.
                                                </li>
                                                <li>User-id dan password akan dibuat berdasarkan data yang diberikan
                                                    oleh Guru kepada Panitia Biro Bebras. Oleh karena itu mohon
                                                    dipastikan agar data benar untuk pencetakan sertifikat</li>
                                                <li>User-id dan password untuk tantangan hanya dapat dipakai untuk
                                                    mencoba akses dan latihan mengerjakan soal <strong>3 kali lewat
                                                        Cek-Akun</strong>, dan <strong>satu kali saat berpartisipasi
                                                        pada Tantangan Bebras</strong>. Akun yang diberikan hanya dapat
                                                    dipakai untuk mengakses tantangan Bebras yang dipilih saat
                                                    pendaftaran (salah satu dari SiKecil/Siaga/Penggalang/Penegak dalam
                                                    bahasa yang dipilih)</li>
                                            </ul>
                                        </li>
                                        <li>Apakah selama Pekan Bebras saya masih bisa latihan soal ? JAWAB: YA
                                            <ul type="a">
                                                <li>Selama pekan bebras, siapapun tetap dapat latihan soal seperti
                                                    halnya pada hari-hari biasa, di <a
                                                        href="https://latihan.bebras.or.id/">https://latihan.bebras.or.id</a>.
                                                    <ol type="i">
                                                        <li>Create Akun (jika belum punya) dengan mendaftarkan email
                                                            yang aktif. Email harus aktif karena Sistem IPB akan
                                                            mengirimkan email konfirmasi ke email aktif tsb</li>
                                                        <li><em>Enroll</em> ke latihan yang dipilih (jika sudah punya
                                                            akun)</li>
                                                    </ol>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>Soal Tantangan Bebras internasional diterjemahkan ke dalam bahasa Indonesia.
                                            Namun, atas permintaan, sejak 2020 tersedia juga dalam bahasa Inggris. Jika
                                            saya memilih ikut Bahasa Indonesia, apakah saya bisa mengakses soal bahasa
                                            Inggris ? atau sebaliknya, jika memilih Bahasa Inggris, apakah bisa
                                            mengakses soal bahasa Indonesia ? JAWAB : TIDAK, peserta hanya bisa
                                            mengakses soal dalam bahasa yang dipilih.
                                            <ul type="a">
                                                <li>Di situs LATIHAN (<a
                                                        href="https://latihan.bebras.or.id">https://latihan.bebras.or.id</a>)
                                                    pengguna bebas untuk latihan bahasa Indonesia dan/atau bahasa
                                                    Inggris, asalkan melakukan “Enroll”.</li>
                                                <li>Di situs TANTANGAN (<a
                                                        href="https://latihan.bebras.or.id">https://latihan.bebras.or.id</a>),
                                                    peserta hanya boleh memilih salah satu bahasa, dan hanya dapat
                                                    mengerjakan soal dalam bahasa yang dipilihnya.</li>
                                            </ul>
                                        </li>
                                    </ol>
                                    <h3>&nbsp;</h3>
                                    <h3 id="pakta"><strong>Pakta Integritas</strong></h3>
                                    <p>Sebelum mengerjakan tantangan, siswa diminta untuk menyepakati Pakta Integritas.
                                        Teks pakta integritas yang harus disetujui adalah sebagai berikut</p>
                                    <p><strong>PAKTA INTEGRITAS Kategori Siaga, Penggalang, dan Penegak</strong></p>
                                    <p>Dengan menekan tombol <em>Start attempt</em> di bawah ini, maka saya menyatakan
                                        bahwa,<br>Saya telah membaca atau meminta orang tua / wali saya membaca
                                        informasi dan prosedur untuk mengikuti Tantangan Bebras 2025 ini, sehingga saya
                                        telah memahami dan menyetujui partisipasi saya dalam tantangan ini;</p>
                                    <ol>
                                        <li>Saya mengikuti Tantangan Bebras 2025 ini atas kemauan sendiri dan tanpa
                                            paksaan dari pihak manapun.</li>
                                        <li>Saya bersedia mengikuti/mengerjakan soal-soal Tantangan Bebras 2025 dengan
                                            jujur dan penuh tanggungjawab.</li>
                                        <li>Tetap menjaga Kesehatan dan mengikuti protokol kesehatan Covid-19 selama
                                            mengikuti tantangan.</li>
                                        <li>Tidak akan mendokumentasikan dan atau menyebarkan soal-soal Tantangan Bebras
                                            2025 dalam bentuk apapun, serta untuk keperluan dan dengan cara apapun.</li>
                                    </ol>
                                    <p><strong>ENGLISH</strong></p>
                                    <p>By clicking on the Start Attempt, I confirm that:</p>
                                    <ol>
                                        <li>I have read or have my parents/guardians read the information and procedures
                                            to take part in the Bebras Challenge 2025 for me hence understand about my
                                            participation in the contest and give my own consent;</li>
                                        <li>My participation in the Bebras Challenge 2025 is on my self-interest and
                                            with my parents/guardians’ consent;</li>
                                        <li>I will do the Bebras Challenge 2025 honestly and responsibly;</li>
                                        <li>I take responsibility of my own health and will comply with the COVID-19
                                            health safety protocols during the contest;</li>
                                        <li>I will not commit fraud by any means including copying and disseminating any
                                            of the Bebras Challenge 2025 documents</li>
                                    </ol>
                                    <p><strong>PAKTA INTEGRITAS SiKecil</strong></p>
                                    <p><strong>TANTANGAN BEBRAS 2025</strong></p>
                                    <p>Dengan menekan tombol <em>Start attempt</em> di bawah ini, maka saya menyatakan
                                        bahwa,<br>Saya telah membaca atau meminta orang tua / wali saya membaca
                                        informasi dan prosedur untuk mengikuti Tantangan Bebras 2025 ini, sehingga saya
                                        telah memahami dan menyetujui partisipasi saya dalam tantangan ini;</p>
                                    <ol>
                                        <li>Saya mengikuti Tantangan Bebras 2025 ini atas kemauan sendiri dan tanpa
                                            paksaan dari pihak manapun.</li>
                                        <li>Saya bersedia mengikuti/mengerjakan soal-soal Tantangan Bebras 2025 dengan
                                            jujur dan penuh tanggungjawab.</li>
                                        <li>Tetap menjaga Kesehatan dan mengikuti protokol kesehatan Covid-19 selama
                                            mengikuti tantangan.</li>
                                        <li>Tidak akan mendokumentasikan dan atau menyebarkan soal-soal Tantangan Bebras
                                            2025 dalam bentuk apapun, serta untuk keperluan dan dengan cara apapun.</li>
                                    </ol>
                                    <p>By clicking on the Start Attempt, I confirm that:</p>
                                    <ol>
                                        <li>I have read or have my parents/guardians read the information and procedures
                                            to take part in the Bebras Challenge 2025 for me hence understand about my
                                            participation in the contest and give my own consent;</li>
                                        <li>My participation in the Bebras Challenge 2025 is on my self-interest and
                                            with my parents/guardians’ consent;</li>
                                        <li>I will do the Bebras Challenge 2025 honestly and responsibly;</li>
                                        <li>I take responsibility of my own health and will comply with the COVID-19
                                            health safety protocols during the contest;</li>
                                        <li>I will not commit fraud by any means including copying and disseminating any
                                            of the Bebras Challenge 2025 documents.</li>
                                    </ol>
                    </div><!-- .entry-content -->
                </div>
            </div>
            {{-- Sidebar --}}
            <aside class="lg:col-span-2 space-y-6">

                {{-- Kard Poster --}}
                <div class="bg-white rounded-xl shadow p-5">
                    <h3 class="text-xl font-semibold mb-3 text-gray-800">
                        Poster Bebras {{ date('Y') }}
                    </h3>

                    <a href="https://bebras.or.id/v3/bebras-indonesia-challenge-2025/">
                        <img src="https://bebras.or.id/v3/wp-content/uploads/2025/10/Poster-Bebras-2025-2-res-300x212.jpg"
                            alt="Poster Bebras" class="rounded-lg w-full h-auto hover:scale-105 transition duration-300">
                    </a>
                </div>

                {{-- Card Jadwal --}}
                <div class="bg-white rounded-xl shadow p-5">
                    <h3 class="text-xl font-semibold mb-3 text-gray-800">
                        Jadwal Tantangan {{ date('Y') }}
                    </h3>

                    <a href="https://bebras.or.id/v3/bebras-indonesia-challenge-2025/">
                        <img src="https://bebras.or.id/v3/wp-content/uploads/2025/10/tabel_jadwal2025.jpg" alt="Jadwal"
                            class="rounded-lg w-full h-auto hover:scale-105 transition duration-300">
                    </a>
                </div>

            </aside>


        </div>
    </div>
@endsection
