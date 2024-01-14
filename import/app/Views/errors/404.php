
<div class="container-fluid">
    <div class="row">
      <div class="col" style="background: radial-gradient(#0D0F68, #0A033B);height:84vh;background-size: cover;background-position: center;">
       <div class="container" style="padding-top:50px;padding-bottom:50px;">
        <div class="row">

          <div class="col"></div>
					<div class="col-md-4" style="padding-top:10vh;padding-bottom:10vh;">
						<div class="container-fluid text-white">
							<div class="row radius-top-15 block-50-orange-dt">
								<h5 class="text-center" style="padding-top:10px">Erreur 404...</h5>
							</div>
							<div class="row radius-bottom-15 bg-dark-dt" style="padding-top:10px;padding-bottom:20px;">
								<?php if (! empty($message) && $message !== '(null)') : ?>
									<?= esc($message) ?>
								<?php else : ?>
									Désolé... Cette page existe pas.
								<?php endif ?>
							</div>
						</div>
					</div>
          <div class="col"></div>
        </div>
      </div>
      </div>
    </div>
  </div>
