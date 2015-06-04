<form class="form-horizontal" method="post" action="?example=search_by_keyword">
    <div class="form-group">
        <label for="keyword" class="col-sm-2 control-label">keyword</label>
        <div class="col-sm-10">
            <input type="text" name="keyword" class="form-control" id="keyword" placeholder="Enter keyword" value="<?php echo (isset($_POST['keyword']))?$_POST['keyword']:''; ?>">
        </div>  
    </div>
    <div class="form-group">
        <label for="category" class="col-sm-2 control-label">category</label>
        <div class="col-sm-10">
            <div class="input-group">
                <input type="text" name="category" class="form-control" id="category" placeholder="Enter category Default:Toys" value="<?php echo (isset($_POST['category']))?$_POST['category']:''; ?>">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button" data-toggle="modal" data-target="#myModal">Example</button>
                </span>
            </div><!-- /input-group -->
        </div>
    </div>
    <div class="form-group">
        <label for="category" class="col-sm-2 control-label">除錯</label>
        <div class="col-sm-10">
          <div class="checkbox">
            <label>
              <input type="checkbox" name="debug" value="1"<?php echo (isset($_POST['debug']) && $_POST['debug'] === '1')?' checked':''; ?>> Debug Mode
            </label>
          </div>
        </div>
    </div>  
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Submit</button>
        </div>
    </div>
  
</form>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        <ul class="list-group">
          <li class="list-group-item">UnboxVideo,16261631,Amazon Instant Video</li>
          <li class="list-group-item">Apparel,51569011,Apparel & Accessories</li>
          <li class="list-group-item">Appliances,2619525011,Appliances</li>
          <li class="list-group-item">ArtsAndCrafts,2617941011,Arts, Crafts & Sewing</li>
          <li class="list-group-item">Automotive,15684181,Automotive</li>
          <li class="list-group-item">Baby,165796011,Baby</li>
          <li class="list-group-item">Beauty,3760911,Beauty</li>
          <li class="list-group-item">Books,1000,Books</li>
          <li class="list-group-item">Photo,13900861,Camera & Photo</li>
          <li class="list-group-item">Wireless,2335752011,Cell Phones & Accessories</li>
          <li class="list-group-item">Classical,36632,Classical Music</li>
          <li class="list-group-item">PCHardware,13900871,Computers</li>
          <li class="list-group-item">DVD,130,DVD</li>
          <li class="list-group-item">Electronics,172282,Electronics</li>
          <li class="list-group-item">VideoGames,979455011,Game Downloads</li>
          <li class="list-group-item">GiftCards,2238192011,Gift Cards</li>
          <li class="list-group-item">Grocery,16310101,Grocery & Gourmet Food</li>
          <li class="list-group-item">HomeGarden,1055398,Home & Garden</li>
          <li class="list-group-item">HealthPersonalCare,3760901,Health & Personal Care</li>
          <li class="list-group-item">Industrial,16310091,Industrial & Scientific</li>
          <li class="list-group-item">Jewelry,3367581,Jewelry</li>
          <li class="list-group-item">KindleStore,133140011,Kindle Store</li>
          <li class="list-group-item">Kitchen,284507,Kitchen & Housewares</li>
          <li class="list-group-item">Magazines,599858,Magazine Subscriptions</li>
          <li class="list-group-item">Miscellaneous,10272111,Miscellaneous</li>
          <li class="list-group-item">MP3Downloads,195209011,MP3 Downloads</li>
          <li class="list-group-item">Music,301668,Music</li>
          <li class="list-group-item">MusicalInstruments,51575011,Musical Instruments</li>
          <li class="list-group-item">OfficeProducts,1064954,Office Products</li>
          <li class="list-group-item">PetSupplies,2619533011,Pet Supplies</li>
          <li class="list-group-item">LawnAndGarden,2972638011,Patio, Lawn & Garden</li>
          <li class="list-group-item">Shoes,672123011,Shoes</li>
          <li class="list-group-item">Software,229534,Software</li>
          <li class="list-group-item">SportingGoods,3375251,Sports & Outdoors</li>
          <li class="list-group-item">Tools,228013,Tools & Hardware</li>
          <li class="list-group-item">Toys,165793011,Toys & Games</li>
          <li class="list-group-item">VHS,404272,VHS</li>
          <li class="list-group-item">VideoGames,468642,Video Games</li>
          <li class="list-group-item">Watches,377110011,Watches</li>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php
    if(isset($_POST['keyword'])){
        /* Example usage of the Amazon Product Advertising API */
        require("amazon_api_class.php");

        $obj = new AmazonProductAPI();
        $keyword = ($_POST['keyword']!='')?$_POST['keyword']:"";
        $category = ($_POST['category']!='')?$_POST['category']:"All";
        try
        {
            $result = $obj->getItemByKeyword($keyword,$category,"TITLE");
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
        }
	  
        if(isset($result['Items'])){
            if(isset($_POST['debug']) && $_POST['debug'] === '1'){
                if(isset($result['Items']['Request']['Errors'])){
?>
    <div class="panel panel-danger">
        <div class="panel-heading">
            <h3 class="panel-title">錯誤訊息</h3>
        </div>
        <div class="panel-body">
            <PRE><?php echo print_r($result['Items']['Request'], TRUE); ?></PRE>
        </div>
    </div>
<?php
                }else{
?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">傳送參數</h3>
        </div>
        <div class="panel-body">
            <PRE><?php echo print_r($result['Items']['Request'], TRUE); ?></PRE>
        </div>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">回應</h3>
        </div>
        <div class="panel-body">
            <PRE><?php echo print_r($result['Items']['Item'], TRUE); ?></PRE>
        </div>
    </div>
<?php
                }
            }
        }
        if(isset($result['BrowseNodes']['BrowseNode'])):
?>
    <table class="table table-hover">
        <tr>
            <th>ASIN</th><th>title</th><th><span class="label label-primary">Creator</span>/<span class="label label-success">Manufacturer</span>/<span class="label label-info">ProductGroup</span></th><th>debug</th>
        </tr>
<?php
        foreach($result['Items']['Item'] as $item):
?>
        <tr>
            <td><?php echo $item['ASIN']; ?></td>
            <td><a href="<?php echo $item['DetailPageURL']; ?>" target="_blank"><?php echo $item['ItemAttributes']['Title']; ?></a></td>
            <td>
                <span class="label label-primary"><?php echo (isset($item['ItemAttributes']['Creator']))?$item['ItemAttributes']['Creator']:'none'; ?></span>/<span class="label label-success"><?php echo $item['ItemAttributes']['Manufacturer']; ?></span>/<span class="label label-info"><?php echo $item['ItemAttributes']['ProductGroup']; ?></span>
            </td>
            <td><?php (isset($_POST['debug']) && $_POST['debug'] === '1')?var_dump($item):''; ?></td>
        </tr>
<?php
        endforeach;
?>
    </table>    
<?php
        endif;
    }
?>
