<?php
/*******
**This widget should use board skin x-board-travel-3 
**for product name and product price
********/


if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

widget_css();

$icon_url = widget_data_url( $widget_config['code'], 'icon' );

$file_headers = @get_headers($icon_url);

if($file_headers[0] == 'HTTP/1.1 404 Not Found') {
    $icon_url = x::url()."/widget/".$widget_config['name']."/img/chat_icon2.png";
}

if( $widget_config['title'] ) $title = $widget_config['title'];
else $title = 'no title';

if( $widget_config['forum1'] ) $_bo_table = $widget_config['forum1'];
else $_bo_table = $widget_config['default_forum_id'];

if ( empty($_bo_table) ) jsAlert('Error: empty $_bo_table ? on widget :' . $widget_config['name']);

if( $widget_config['no'] ) $limit = $widget_config['no'];
else $limit = 3;

$list = g::posts( array(
			"bo_table" 	=>	$_bo_table,
			"limit"		=>	$limit,
			"select"	=>	"idx,domain,bo_table,wr_id,wr_parent,wr_is_comment,wr_comment,ca_name,wr_datetime,wr_hit,wr_good,wr_nogood,wr_name,mb_id,wr_subject,wr_content"
				)
		);
		
$title_query = "SELECT bo_subject FROM ".$g5['board_table']." WHERE bo_table = '".$_bo_table."'";
$title = cut_str(db::result( $title_query ),10,"...");

?>


<div class="travel_2_timed_list_with_image">
    <div class="title">
		<img class='icon' src='<?=$icon_url?>'/>
		<a href='<?=G5_BBS_URL?>/board.php?bo_table=<?=$_bo_table?>'><?=$title?></a>
		<a class='more_button' href='<?=G5_BBS_URL?>/board.php?bo_table=<?=$_bo_table?>'>자세히</a>
		<div style='clear:right;'></div>
	</div>
		<div class='travel_images_2_container'>
    <table cellpadding=0 cellspacing=0 >
    <?php for ($i=0; $i<count($list); $i++) {
		if( $i+1 == count($list) ){			
			$nopadding = 'no-padding';
		}
		else $nopadding = null;
	?>
	<tr valign='top'>
		
            <?php			
			$imgsrc = x::post_thumbnail( $_bo_table , $list[$i]['wr_id'], 32, 32 );

			if( $imgsrc ) $img = "<img src='".$imgsrc['src']."'/>";
			else $img = "<div class='no-image'></div>";
			
			echo "<td class='$nopadding' width=40><div class='travel_2_image'><a href='".$list[$i]['url']."'>$img</a></div></td>";
			        
            echo "<td class='$nopadding'><div class='travel_2_subject'><a href='".$list[$i]['url']."'>".$list[$i]['subject']."</a></div></td>";
						
             ?>	
	</tr>	
    <?php }  ?>
    <?php if (count($list) == 0) { //게시물이 없을 때  
	?>
		<tr valign='top'>
			<td class='$nopadding' width=40><div class='travel_2_image'><a href='http://www.philgo.net/bbs/board.php?bo_table=help&wr_id=5'><img src='<?=$latest_skin_url?>/img/no-image.png' /></a></div></td>      
            <td class='$nopadding' width=170><div class='travel_2_subject'><a href='http://www.philgo.net/bbs/board.php?bo_table=help&wr_id=5'>사이트 만들기 안내</a></div></td>
		</tr>
		<tr valign='top'>
			<td class='$nopadding' width=40><div class='travel_2_image'><a href='http://www.philgo.net/bbs/board.php?bo_table=help&wr_id=4'><img src='<?=$latest_skin_url?>/img/no-image.png' /></a></div></td>      
            <td class='$nopadding' width=170><div class='travel_2_subject'><a href='http://www.philgo.net/bbs/board.php?bo_table=help&wr_id=4'>블로그 만들기</a></div></td>
		</tr>
		<tr valign='top'>
			<td class='$nopadding' width=40><div class='travel_2_image'><a href='http://www.philgo.net/bbs/board.php?bo_table=help&wr_id=2'><img src='<?=$latest_skin_url?>/img/no-image.png' /></a></div></td>      
            <td class='$nopadding' width=170><div class='travel_2_subject'><a href='http://www.philgo.net/bbs/board.php?bo_table=help&wr_id=2'>여행사 사이트 만들기</a></div></td>
		</tr>
    <?php }  ?>
    </table>   
	</div>
</div>