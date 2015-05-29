<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if(isset($_POST['OfferListingId']) )
{
  require("amazon_api_class.php");

  try
  {
      //只新增一次cart
      if(isset($_SESSION['cart']))
      {
        echo '只新增一次cart';
        echo '<PRE>';
        print_r($_SESSION['cart']);
        echo '/<PRE>';
      }
      else {
        $obj = new AmazonProductAPI();
        $result = $obj->create_cart();
        echo '第一次新增';
        print_r($result);
        echo '<br/>session: ';
        print_r($_SESSION['cart']);
      }


  }
  catch(Exception $e)
  {
      echo $e->getMessage();
  }
}

if(isset($_POST['asin_str']) ):

    /* Example usage of the Amazon Product Advertising API */

    require("amazon_api_class.php");
    $obj = new AmazonProductAPI();
    try
    {

        $result = $obj->getCartPage($_POST['asin_str']);

    }
    catch(Exception $e)
    {
        echo $e->getMessage();
    }

?>
<form class="form-horizontal" method="post" action="?example=shopping_cart">
<div class="row">
  <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
      <img src="<?php echo $result['item_xml']['Items']['Item']['LargeImage']['URL']; ?>" alt="...">
      <div class="caption">
        <h3><?php echo $result['item_xml']['Items']['Item']['ItemAttributes']['Title']; ?></h3>
        <p>item type:<?php echo $result['item_xml']['Items']['Request']['ItemLookupRequest']['IdType']; ?></p>
        <p>item code:<?php echo $result['item_xml']['Items']['Request']['ItemLookupRequest']['ItemId']; ?></p>
        <p>Color <?php echo $result['item_xml']['Items']['Item']['ItemAttributes']['Color'] ?></p>
        <p>ListPrice <?php echo $result['item_xml']['Items']['Item']['ItemAttributes']['ListPrice']['CurrencyCode']; ?></p>
        <input type="hidden" name="OfferListingId" value="<?php echo $result['item_xml']['Items']['Item']['Offers']['Offer']['OfferListing']['OfferListingId']; ?>"/>
        <input type="hidden" name="Quantity" value="1"/>
        <select class="form-control">
          <option>選擇顏色</option>
          <?php foreach($result['p_item_xml']['Items']['Item']['Variations']['Item'] as $info):?>
            <option><?php echo $info['ItemAttributes']['Color'];?></option>
          <?php endforeach;?>
        </select>
        <p></p>
        <select class="form-control">
          <option>選擇尺寸</option>
          <?php foreach($result['p_item_xml']['Items']['Item']['Variations']['Item'] as $info):?>
            <option><?php echo $info['ItemAttributes']['Size'];?></option>
          <?php endforeach;?>
        </select>
        <p>
        </p>
          <!--<a href="#" class="btn btn-primary" role="button"><?php echo $result['item_xml']['Items']['Item']['ItemAttributes']['PackageQuantity'] ?></a>-->
          <a href="#" class="btn btn-primary" role="button"><?php echo $result['item_xml']['Items']['Item']['Offers']['TotalOffers']; ?></a>
          <button type="submit" class="btn btn-default">加入購物車</button>
        </p>
      </div>
    </div>
  </div>
</div>
</form>

<?php endif;?>

<form class="form-horizontal" method="post" action="?example=shopping_cart">
  <div class="form-group">
    <label for="asin_str" class="col-sm-2 control-label">查詢</label>
    <div class="col-sm-10">
      <input type="text" name="asin_str" class="form-control" id="asin_str" placeholder="請輸入你想看到的單品頁ASIN CODE">
      <b>ex: B000UYJBOW</b>
      <b><a target="_blank" href="http://www.amazon.com/Vans-AUTHENTIC-SKATE-SHOES-WHITE/dp/B000UYJBOW/ref=sr_1_6?s=sporting-goods&ie=UTF8&qid=1432261211&sr=1-6&keywords=shoes">範例單品頁</a>
    </div>

  </div>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Submit</button>
    </div>
  </div>
</form>

<?php
if(isset($_SESSION['cart']))
{
  echo 'Cart Session';
  echo '<PRE>';
  print_r($_SESSION['cart']);
  echo '</PRE>';
}

?>
