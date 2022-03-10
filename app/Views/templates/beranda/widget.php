<div class="card">
    <div class="card-body">
        <h3>Aktifitas Terakhir</h3>
        <hr>
        <?php foreach($dataNotif as $key => $notif) :?>
        <div class="list-group list-group-flush">
            <div class="media mb-3">
                <div class="media-body">
                    <h6 class="mt-0 mb-1 h6"><?= $notif['jenisNotifikasi']?></h6>
                    <small class="text-secondary"><?= $notif['isiNotifikasi']?></small>
                </div>
            </div>

        </div> 
        <?php if($key > $limit
        ) break ;endforeach;?>   
    </div>
</div>