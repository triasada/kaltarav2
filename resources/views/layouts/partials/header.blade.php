<div id="top-header" class="row py-2">
    <div id="header-search" class="ml-auto my-auto">
        <form class="form-inline">
            <input type="text" name="search" id="search" placeholder="cari">
        </form>
    </div>
    <div id="header-social-media" class="ml-2 mr-lg-5 mr-2 my-auto">
        <a target="_blank" href="{{ $settings[WEB_SETTING_TWITTER] }}" class="text-white">
            <i class="fa-brands fa-twitter-square"></i>
        </a>
        <a target="_blank" href="{{ $settings[WEB_SETTING_FACEBOOK] }}" class="text-white">
            <i class="fa-brands fa-facebook-square"></i>
        </a>
        <a target="_blank" href="{{ $settings[WEB_SETTING_YOUTUBE] }}" class="text-white">
            <i class="fa-brands fa-youtube-square"></i>
    </a>
        <a target="_blank" href="{{ $settings[WEB_SETTING_INSTAGRAM] }}" class="text-white">
            <i class="fa-brands fa-instagram-square"></i>
        </a>
    </div>
</div>

<div id="logo-header" class="row d-none d-lg-block">
    <div class="col-md-11 offset-md-1 my-3">
        <a href="{{ route('home') }}">
            <img src="{{ asset('img/new-logo.png') }}" class="img-fluid ml-3" style="max-height: 35px">
        </a>
    </div>
</div>

<div id="main-header" class="row mb-2">
    <div class="col-lg-11 offset-lg-1 text-center">
        <nav class="navbar navbar-expand-sm navbar-dark bg-transparent">
            <a class="navbar-brand d-lg-none" href="{{ route('home') }}">
                <img src="{{ asset('img/new-logo.png') }}" class="img-fluid ml-3">
            </a>
            <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0 text-left">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('home') }}"><i class="fa-solid fa-house"></i> Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Profil</a>
                        <div class="dropdown-menu" aria-labelledby="dropdownProfile">
                            <a class="dropdown-item" href="{{ route('page.read', [PAGE_STRUKTUR_ORGANISASI]) }}">Struktur Organisasi</a>
                            <a class="dropdown-item" href="{{ route('page.read', [PAGE_VISI_MISI]) }}">Visi & Misi</a>
                            <a class="dropdown-item" href="{{ route('page.read', [PAGE_TUPOKSI]) }}">Tupoksi</a>
                            <a class="dropdown-item" href="{{ route('page.read', [PAGE_TPJK]) }}">TPJK</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdownInformasi" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Informasi</a>
                        <div class="dropdown-menu" aria-labelledby="dropdownInformasi">
                            <a class="dropdown-item" href="{{ route('news') }}">Berita Terbaru</a>
                            <a class="dropdown-item" href="{{ route('page.read', [PAGE_PERATURAN]) }}">Peraturan</a>
                            <a class="dropdown-item" href="{{ route('photo-gallery.index') }}">Galeri</a>
                            <a class="dropdown-item" href="{{ route('gallery-video') }}">Galeri Video</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdownInformasi" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Data</a>
                        <div class="dropdown-menu" aria-labelledby="dropdownInformasi">
                            <a class="dropdown-item" href="{{ route('badan-usaha') }}">Badan Usaha Jakon</a>
                            <a class="dropdown-item" href="{{ route('tenaga-kerja-konstruksi') }}">Tenaga Kerja Konstruksi (Ahli, Terampil)</a>
                            <a class="dropdown-item" href="{{ route('asosiasi') }}">Asosiasi Jasa Konstruksi (Badan Usaha, Profesi)</a>
                            <a class="dropdown-item" href="{{ route('alat-berat') }}">Alat Berat</a>
                            <a class="dropdown-item" href="{{ route('bahan-dan-material') }}">Bahan & Material</a>
                            <a class="dropdown-item" href="{{ route('proyek') }}">Proyek Pekerjaan (APBN, APBD, Pendanaan Lain)</a>
                            <a class="dropdown-item" href="{{ route('perguruan-tinggi') }}">Perguruan Tinggi</a>
                            <a class="dropdown-item" href="{{ route('pencari-kerja-konstruksi') }}">Pencari Kerja Konstruksi</a>
                            <a class="dropdown-item" href="{{ route('harga_satuan.index_public') }}">Harga Satuan</a>
                            <a class="dropdown-item" href="{{ route('pekerjaan_public.index') }}">Harga Satuan Pekerjaan</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdownInformasi" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pelatihan</a>
                        <div class="dropdown-menu" aria-labelledby="dropdownInformasi">
                            <a class="dropdown-item" href="{{ route('announcement') }}">Pengumuman</a>
                            <a class="dropdown-item" href="{{ route('registration') }}">Registrasi</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdownInformasi" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pengawasan</a>
                        <div class="dropdown-menu" aria-labelledby="dropdownInformasi">
                            <a class="dropdown-item" href="{{ route('page.read', [PAGE_TERTIP_USAHA_DAN_PERIZINAN]) }}">Tertib Usaha & Perizinan  </a>
                            <a class="dropdown-item" href="{{ route('page.read', [PAGE_TERTIP_PENYELENGGARAAN]) }}">Tertib Penyelenggaraan</a>
                            <a class="dropdown-item" href="{{ route('page.read', [PAGE_TERTIP_PEMANFAATAN_JASA]) }}">Tertib Pemanfaatan Jasa</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdownInformasi" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Kelembagaan</a>
                        <div class="dropdown-menu" aria-labelledby="dropdownInformasi">
                            <a class="dropdown-item" href="{{ route('page.read', [PAGE_ALOKASI_ANGGARAN]) }}">Alokasi Anggaran</a>
                            <a class="dropdown-item" href="{{ route('page.read', [PAGE_TPJK2]) }}">TPJK</a>
                            <a class="dropdown-item" href="{{ route('page.read', [PAGE_FJK]) }}">FJK</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdownInformasi" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Link Terkait</a>
                        <div class="dropdown-menu" aria-labelledby="dropdownInformasi">
                            @foreach ($links as $link)
                                <a class="dropdown-item" target="_blank" href="{{ $link->url }}">{{ $link->name }}</a>
                            @endforeach
                            {{-- <a class="dropdown-item" href="{{ route('oss') }}">OSS</a>
                            <a class="dropdown-item" href="{{ route('lpjk') }}">LPJK</a>
                            <a class="dropdown-item" href="{{ route('sipjaki') }}">SIPJAKI</a> --}}
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
