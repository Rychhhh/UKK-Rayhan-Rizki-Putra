<ul class="navbar-nav">
    @if(Auth::user()->role === 'administrator')
    <li class="nav-item">
      <a class="nav-link" href="{{ route('dashboard')}}">
        <i class="ni ni-planet text-orange"></i>
        <span class="nav-link-text">Dashboard</span>
      </a>
    </li>
    
    <li class="nav-item">
      <a class="nav-link active" href="{{ route('users.index')}}">
        <i class="ni ni-single-02 text-yellow"></i>
        <span class="nav-link-text">User</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link " href="{{ route('kelas.index')}}">
        <i class="ni ni-planet text-orange"></i>
        <span class="nav-link-text">Kelas</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link " href="{{ route('siswa.index')}}">
        <i class="ni ni-single-02 text-orange"></i>
        <span class="nav-link-text">Siswa</span>
      </a>
    </li>


    <li class="nav-item">
      <a class="nav-link " href="{{ route('spp.index')}}">
        <i class="ni ni-bullet-list-67 text-default"></i>
        <span class="nav-link-text">Spp</span>
      </a>
    </li>


    <li class="nav-item">
      <a class="nav-link " href="{{ route('pembayaran.index')}}">
        <i class="ni ni-planet text-orange"></i>
        <span class="nav-link-text">Pembayaran</span>
      </a>
    </li> 

    @endif

    @if(Auth::user()->role === 'petugas')
    <li class="nav-item">
      <a class="nav-link" href="{{ route('dashboard')}}">
        <i class="ni ni-planet text-orange"></i>
        <span class="nav-link-text">Dashboard</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ route('historypetugas')}}">
        <i class="ni ni-box-2 text-danger"></i>
        <span class="nav-link-text">History Pembayaran</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link " href="{{ route('pembayaran.index')}}">
        <i class="ni ni-planet text-orange"></i>
        <span class="nav-link-text">Pembayaran</span>
      </a>
    </li>

    @endif

    @if(Auth::user()->role === 'siswa')
    <li class="nav-item">
      <a class="nav-link" href="{{ route('history')}}">
        <i class="ni ni-box-2 text-danger"></i>
        <span class="nav-link-text">History Pembayaran</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ route('status-tunggakan')}}">
        <i class="ni ni-bullet-list-67 text-primary"></i>
        <span class="nav-link-text">Status Tunggakan</span>
      </a>
    </li>
    @endif 

  </ul>