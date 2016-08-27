<div class="un_container">
    <?php
	$laravel = app();
	echo "Your Laravel version is ".$laravel::VERSION;
	?> |

	Siteswitch:  {{ env('SITE_SWITCH') }} (w = web, m = mobile). |

	PHP Version: {{ phpversion() }}
    </div>