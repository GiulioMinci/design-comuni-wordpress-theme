<?php
$current_user = wp_get_current_user();
$last_notification = get_user_meta($current_user->ID,"_dci_last_notification", true);
?>

<div class="it-user-wrapper nav-item dropdown" style="background-color: #00402b;">
    <a aria-expanded="false" class="btn btn-primary btn-icon btn-full" data-toggle="dropdown" href="#" style="background-color: #00402b; color: #ffffff;">
        <span class="rounded-icon">
            <img src="<?php echo dci_get_user_avatar($current_user); ?>" class="border rounded-circle icon-white" alt="<?php echo dci_get_display_name($current_user->ID); ?>" style="max-width:20px;"/>
        </span>
        <span class="d-none d-lg-block">
            <?php echo dci_get_display_name($current_user->ID); ?>
        </span>
        <svg class="icon icon-white d-none d-lg-block">
            <use xlink:href="#it-expand"></use>
        </svg>
    </a>
    <div class="dropdown-menu" style="background-color: #00402b;">
        <div class="row">
            <div class="col-12">
                <div class="link-list-wrapper">
                    <ul class="link-list">
                        <li>
                            <a class="list-item" href="#" style="color: #ffffff;"><span>I miei servizi</span></a>
                        </li>
                        <li>
                            <a class="list-item" href="#" style="color: #ffffff;"><span>Le mie pratiche</span></a>
                        </li>
                        <li>
                            <a class="list-item" href="#" style="color: #ffffff;"><span>Notifiche</span></a>
                        </li>
                        <li>
                            <span class="divider"></span>
                        </li>
                        <li>
                            <a class="list-item" href="#" style="color: #ffffff;"><span>Impostazioni</span></a>
                        </li>
                        <li>
                            <a class="list-item left-icon" href="<?php echo wp_logout_url(); ?>" style="color: #ffffff;">
                                <svg class="icon icon-primary icon-sm left">
                                    <use xlink:href="#it-external-link"></use>
                                </svg>
                                <span class="fw-bold">Esci</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
