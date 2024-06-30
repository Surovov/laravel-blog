<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.7.6/css/uikit.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dragula/3.7.2/dragula.min.css">
    @vite('resources/assets/admin/theme.css')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.7.6/js/uikit.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.7.6/js/uikit-icons.min.js"></script>
</head>
<body>
  <div class="uk-navbar-container tm-navbar-container uk-sticky uk-sticky-fixed" uk-sticky="media: 960; target-offset: 0; " style="position: fixed !important; width: 1920px !important; margin-top: 0px !important; top: 0px;">
      <div class="uk-container uk-container-expand">
          <nav class="uk-navbar" uk-navbar="">
              <div class="uk-navbar-left">
                  <a class="uk-navbar-item uk-logo" href="../" aria-label="Back to Home">
                    <!-- <img src="../images/uikit-logo.svg" class="uk-margin-small-right" width="28" height="34" alt="UIkit" />  -->
                    <span class="uk-margin-small-right" uk-icon="icon: home;"></span>
                    Blog
                  </a>
              </div>
              <div class="uk-navbar-right">
                  <div class="uk-navbar-item">
                      <span id="docsearch">
                          <button type="button" class="DocSearch DocSearch-Button" aria-label="Search">
                              <span class="DocSearch-Button-Container">
                                  <svg width="20" height="20" class="DocSearch-Search-Icon" viewBox="0 0 20 20" aria-hidden="true">
                                      <path
                                          d="M14.386 14.386l4.0877 4.0877-4.0877-4.0877c-2.9418 2.9419-7.7115 2.9419-10.6533 0-2.9419-2.9418-2.9419-7.7115 0-10.6533 2.9418-2.9419 7.7115-2.9419 10.6533 0 2.9419 2.9418 2.9419 7.7115 0 10.6533z"
                                          stroke="currentColor"
                                          fill="none"
                                          fill-rule="evenodd"
                                          stroke-linecap="round"
                                          stroke-linejoin="round"
                                      ></path>
                                  </svg>
                                  <span class="DocSearch-Button-Placeholder">Search</span>
                              </span>
                              <span class="DocSearch-Button-Keys"><kbd class="DocSearch-Button-Key">⌘</kbd><kbd class="DocSearch-Button-Key">K</kbd></span>
                          </button>
                      </span>
                  </div>
                  <ul class="uk-navbar-nav uk-visible@m">
                      <li><a href="../pro">Pro</a></li>
                      <li class="uk-active"><a href="../docs/introduction" aria-current="page">Documentation</a></li>
                      <li><a href="../changelog">Changelog</a></li>
                  </ul>
                  <div class="uk-navbar-item uk-visible@m">
                      <a class="uk-button uk-button-default tm-button-default uk-icon" href="../download">
                          Download <canvas uk-icon="download" width="20" height="20" class="uk-icon" hidden=""></canvas>
                      </a>
                  </div>
                  <a class="uk-navbar-toggle uk-hidden@m uk-icon uk-navbar-toggle-icon" uk-navbar-toggle-icon="" href="#offcanvas" uk-toggle="" aria-label="Open menu" role="button">
                  </a>
              </div>
          </nav>
      </div>
  </div>
  @include('admin.sidebar')
  <div id="tm-main" class="tm-main uk-section uk-section-default">
    <div class="uk-container uk-position-relative">
      <div class="uk-padding-large uk-padding-remove-vertical  ">
      @include('admin.errors')
      @yield('content')
      </div>
    </div>
  </div>


  <footer class="uk-section uk-section-small uk-text-center">
      <p>&copy; 2024 Task Manager. Все права защищены.</p>
  </footer>

  @vite('resources/assets/admin/editor.js')
  
</body>
</html>

