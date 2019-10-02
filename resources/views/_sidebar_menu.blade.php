<nav class="sidebar sidebar-offcanvas" id="sidebar" style="border-top: 1px solid #eee; border-right: 1px solid #eee">
    <ul class="nav">  
        <li class="nav-item nav-profile" style="background-color: #f9f9f9">
            <div class="nav-link">
              <div class="user-wrapper">
                <div class="profile-image">
                  <img src="{{ Auth::user()->thumb_image }}" alt="profile image">
                </div>
                <div class="text-wrapper">
                  <p class="profile-name">{{ Auth::user()->nama_petugas }}</p>
                  <div>
                    <small class="designation text-muted">{{ Auth::user()->level->nama_level }}</small>
                    <span class="status-indicator online"></span>
                  </div>
                </div>
              </div>  
              
              <button type="button"class="btn btn-success btn-block"data-toggle="modal"data-target="#modalEdit"data-whatever="@getbootstrap">Edit Profile</button>
            </div>
          </li>    
        <li class="nav-item @if(\Request::segment(1) == null && \Request::segment(2) == null) active @endif">
            <a class="nav-link" href="{{ url('/') }}">
                <i class="menu-icon mdi mdi-television"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        @if(Auth::user()->id_level == 1)
        <li class="nav-item @if(\Request::segment(1) == 'petugas' && \Request::segment(2) == null) active @endif">
            <a class="nav-link" href="{{ url('/petugas') }}">
                <i class="menu-icon mdi mdi-shield"></i>
                <span class="menu-title">Petugas</span>
            </a>
        </li>
        <li class="nav-item @if(\Request::segment(1) == 'pegawai' && \Request::segment(2) == null) active @endif">
            <a class="nav-link" href="{{ url('/pegawai') }}">
                <i class="menu-icon fa fa-user"></i>
                <span class="menu-title">Pegawai</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#mn-inventaris" @if(\Request::segment(1) == 'inventaris' && \Request::segment(2) == null || \Request::segment(1) == 'jenis-inventaris' && \Request::segment(2) == null || \Request::segment(1) == 'ruang-inventaris' && \Request::segment(2) == null)  aria-expanded="true" @else aria-expanded="false" @endif aria-controls="mn-inventaris">
                <i class="menu-icon mdi mdi-table"></i>
                <span class="menu-title">Inventaris</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="mn-inventaris">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link @if(\Request::segment(1) == 'inventaris' && \Request::segment(2) == null) active @endif" href="{{ url('/inventaris') }}">Data Inventaris</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(\Request::segment(1) == 'jenis-inventaris' && \Request::segment(2) == null)  active @endif" href="{{ url('/jenis-inventaris') }}">Jenis</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(\Request::segment(1) == 'ruang-inventaris' && \Request::segment(2) == null)  active @endif" href="{{ url('/ruang-inventaris') }}">Ruang</a>
                    </li>
                </ul>
            </div>
        </li>
        @endif
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#mn-peminjaman" @if(\Request::segment(1) == 'peminjaman' && \Request::segment(2) == 'add' || \Request::segment(1) == 'peminjaman' && \Request::segment(2) == null)  aria-expanded="true" @else aria-expanded="false" @endif aria-controls="mn-peminjaman">
                <i class="menu-icon mdi mdi-dropbox"></i>
                <span class="menu-title">Peminjaman</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="mn-peminjaman">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link @if(\Request::segment(1) == 'peminjaman' && \Request::segment(2) == 'add')  active @endif" href="{{ url('/peminjaman/add') }}"> Pinjam Inventaris </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(\Request::segment(1) == 'peminjaman' && \Request::segment(2) == null)  active @endif" href="{{ url('/peminjaman/') }}"> List Pinjaman </a>
                    </li>
                </ul>
            </div>
        </li>
        @if(Auth::user()->id_level == 1 || Auth::user()->id_level == 2)

        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#mn-pengembalian" @if(\Request::segment(1) == 'pengembalian' && \Request::segment(2) == 'add' || \Request::segment(1) == 'pengembalian' && \Request::segment(2) == null)  aria-expanded="true" @else aria-expanded="false" @endif aria-controls="mn-pengembalian">
                <i class="menu-icon mdi mdi-restart"></i>
                <span class="menu-title">Pengembalian</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="mn-pengembalian">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link @if(\Request::segment(1) == 'pengembalian' && \Request::segment(2) == 'add')  active @endif" href="{{ url('/pengembalian/add') }}"> Kembalikan Inventaris </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link @if(\Request::segment(1) == 'pengembalian' && \Request::segment(2) == null)  active @endif" href="{{ url('/pengembalian/') }}"> List Pengembalian </a>
                    </li>
                </ul>
            </div>
        </li> 
        @endif

        @if(Auth::user()->id_level == 1)
        <li class="nav-item ">
            <a class="nav-link" data-toggle="collapse" href="#mn-laporan" @if(\Request::segment(1) == 'laporan-inventaris' && \Request::segment(2) == null || \Request::segment(1) == 'laporan-peminjaman' && \Request::segment(2) == null || \Request::segment(1) == 'laporan-pengembalian' && \Request::segment(2) == null)  aria-expanded="true" @else aria-expanded="false" @endif aria-controls="mn-laporan">
                <i class="menu-icon mdi mdi-file"></i>
                <span class="menu-title">Laporan</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="mn-laporan">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link @if(\Request::segment(1) == 'laporan-inventaris' && \Request::segment(2) == null) active @endif" href="{{ url('/laporan-inventaris') }}"> Laporan Inventaris </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(\Request::segment(1) == 'laporan-peminjaman' && \Request::segment(2) == null) active @endif" href="{{ url('/laporan-peminjaman/') }}"> Laporan Peminjaman </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(\Request::segment(1) == 'laporan-pengembalian' && \Request::segment(2) == null) active @endif" href="{{ url('/laporan-pengembalian/') }}"> Laporan Pengembalian </a>
                    </li>
                </ul>
            </div>
        </li> 
        @endif 
                  
</ul>
</nav>