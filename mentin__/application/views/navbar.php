<!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      {if 'stat_overview'|in_array:$role:$admin  and $elements->stat_overview eq 1}
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{$base_url}chartreport/overview" class="nav-link text-info"><i class="fa fa-bar-chart" aria-hidden="true"></i> Tổng quan</a>
      </li>
      {/if}
      {if 'dongbo'|in_array:$role:$admin  and $elements->dongbo eq 1}
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{$base_url}card/dongbo" class="nav-link text-info"><i class="fa fa-refresh" aria-hidden="true"></i> Đồng bộ thẻ</a>
      </li>
      {/if}
      {if 'backup'|in_array:$role:$admin  and $elements->backup eq 1}
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{$base_url}backup" class="nav-link text-danger"><i class="fa fa-refresh" aria-hidden="true"></i> Sao lưu</a>
      </li>
      {/if}
      {if $admin eq 1}
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{$base_url}user/license" class="nav-link"><i class="fa fa-copyright" aria-hidden="true"></i> Bản quyền</a>
      </li>
      {/if}
      {if 'working'|in_array:$role:$admin  and $elements->working eq 1}
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{$base_url}working/index" class="nav-link text-info"><i class="fa fa-refresh" aria-hidden="true"></i> Working</a>
      </li>
      {/if}
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <!-- <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div> -->
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link" onclick="openFullscreen();" id="fullscreen"><i class="fa fa-desktop nav-icon"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link" onclick="closeFullscreen();" id="exitfullscreen"><i class="fa fa-desktop nav-icon"></i></a>
      </li>
    </ul>
  </nav>
<!-- /.navbar -->