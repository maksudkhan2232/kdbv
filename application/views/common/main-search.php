<div class="popup-search-box d-none d-lg-block">
    <button class="searchClose border-theme text-theme"><i class="fal fa-times"></i></button>
    <form action="<?php echo base_url()."search/"; ?>" id="MySearchForm" enctype="multipart/form-data" method="post" accept-charset="utf-8">
        <input type="text" class="border-theme TopSearchText" placeholder="What are you looking for" name="TopSearchText" id="TopSearchText"> 
        <button type="submit" id="TopSearch"><i class="fal fa-search"></i></button>
    </form>
</div>