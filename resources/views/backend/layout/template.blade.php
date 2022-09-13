<!DOCTYPE html>
<html lang="en">

<head>
  @include('backend.includes.header')
  @include('backend.includes.css')
  @livewireStyles
</head>

<body class="g-sidenav-show  bg-gray-100">
  <!-- Sidebar -->
  @include('backend.includes.sidebar')
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Topbar -->
    @include('backend.includes.topbar')
    <!-- Body -->
    {{ $slot }}
  </main>
  <!-- Settings -->
  @include('backend.includes.settings')
  <!--  :::Core JS Files:::  -->
  @livewireScripts
  @include('backend.includes.scripts')
</body>

</html>