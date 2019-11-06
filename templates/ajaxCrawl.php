
<?php foreach($data as $d): ?>
            
<div class="row daaa mw-100">
    <div class="rounded m-3 border border-light col">

        <div class = "row">
            <div class="mt-3 ml-3 float-left mw-100 text-white">  <?php echo $d->username; ?> </div>
        </div>

        <div class = "row">
            <div class="mt-3 ml-5 text-white">  <?php echo $d->post_message; ?> </div>
        </div>

        <div class = "row">
            <div class= "col">
                <div class="float-right mt-3 mb-3 text-white">  <?php echo $d->posted_on; ?> </div>
            </div>
        </div>

    </div> 
</div>
<?php endforeach;?>   
