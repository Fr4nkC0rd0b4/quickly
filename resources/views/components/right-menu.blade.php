<!-- Right Sidebar -->
<div class="right-bar">

    <div class="rightbar-title">
        <a href="javascript: void(0);" class="right-bar-toggle float-right">
            <i class="fa fa-times-circle-o fa-2x"></i>
        </a>
        <h5 class="m-0">Settings</h5>
    </div>

    <div class="rightbar-content h-100" style="overflow: auto;" data-simplebar>
        <div class="simplebar-wrapper" style="margin: 0px;">
            <div class="simplebar-height-auto-observer-wrapper">
                <div class="simplebar-height-auto-observer"></div>
            </div>
            <div class="simplebar-mask">
                <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                    <div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content"
                        style="height: 100%; overflow: hidden scroll;">
                        <div class="simplebar-content" style="padding: 0px;">
                            <div class="p-3">
                                <div class="alert alert-warning" role="alert">
                                    <strong>Personalizar </strong> el esquema de color general, el menú de la barra
                                    lateral, etc...
                                </div>

                                <!-- Settings -->
                                <h5 class="mt-3">Color Scheme</h5>
                                <hr class="mt-1">

                                <div class="custom-control custom-switch mb-1">
                                    <input type="radio" class="custom-control-input" name="color-scheme-mode"
                                        value="light" id="light-mode-check" checked>
                                    <label class="custom-control-label" for="light-mode-check">Light Mode</label>
                                </div>

                                <div class="custom-control custom-switch mb-1">
                                    <input type="radio" class="custom-control-input" name="color-scheme-mode"
                                        id="dark-mode-check">
                                    <label class="custom-control-label" for="dark-mode-check">Dark Mode</label>
                                </div>

                                <!-- Width -->
                                <h5 class="mt-4">Width</h5>
                                <hr class="mt-1">
                                <div class="custom-control custom-switch mb-1">
                                    <input type="radio" class="custom-control-input" name="width" value="fluid"
                                        id="fluid-check">
                                    <label class="custom-control-label" for="fluid-check">Fluid</label>
                                </div>
                                <div class="custom-control custom-switch mb-1">
                                    <input type="radio" class="custom-control-input" name="width" value="boxed"
                                        id="boxed-check" checked>
                                    <label class="custom-control-label" for="boxed-check">Boxed</label>
                                </div>

                                <!-- Left Sidebar-->
                                <h5 class="mt-4">Left Sidebar</h5>
                                <hr class="mt-1">
                                <div class="custom-control custom-switch mb-1">
                                    <input type="radio" class="custom-control-input" name="theme" value="default"
                                        id="default-check" checked>
                                    <label class="custom-control-label" for="default-check">Default</label>
                                </div>

                                <div class="custom-control custom-switch mb-1">
                                    <input type="radio" class="custom-control-input" name="theme" value="light"
                                        id="light-check">
                                    <label class="custom-control-label" for="light-check">Light</label>
                                </div>

                                <div class="custom-control custom-switch mb-3">
                                    <input type="radio" class="custom-control-input" name="theme" value="dark"
                                        id="dark-check">
                                    <label class="custom-control-label" for="dark-check">Dark</label>
                                </div>

                                <div class="custom-control custom-switch mb-1">
                                    <input type="radio" class="custom-control-input" name="compact" value="fixed"
                                        id="fixed-check" checked>
                                    <label class="custom-control-label" for="fixed-check">Fixed</label>
                                </div>

                                <div class="custom-control custom-switch mb-1">
                                    <input type="radio" class="custom-control-input" name="compact" value="condensed"
                                        id="condensed-check">
                                    <label class="custom-control-label" for="condensed-check">Condensed</label>
                                </div>

                                <div class="custom-control custom-switch mb-1">
                                    <input type="radio" class="custom-control-input" name="compact" value="scrollable"
                                        id="scrollable-check">
                                    <label class="custom-control-label" for="scrollable-check">Scrollable</label>
                                </div>

                                <button class="btn btn-primary btn-block mt-4" id="resetBtn">Reset to Default</button>
                            </div><!-- end padding-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="rightbar-overlay"></div>
<!-- /Right-bar -->
