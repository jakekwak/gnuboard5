<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (!$board['bo_use_tag']) return;

// 게시판에 tags라는 필드를 추가함.  매번???
// $sql_table	=	"ALTER TABLE {$write_table} ADD COLUMN tags varchar(255) DEFAULT '' COMMENT '태그'";
// sql_query( $sql_table , false );	

if( $wr_id && $_POST['tags'] ){
	$tags = $_POST['tags'];

  // 게시판 글 $wr_id에 $tags 값을 추가함.
  // $sql_table	=	"update $write_table set tags = '$tags' where wr_id = '$wr_id'";
	// sql_query( $sql_table , false );	
	
  // ,로 된것을 분리함.
	$arrtag = explode(",", $tags);

  // Write/update시 기존의 태그를 모두 지우고 다시 작성함
  $sql_table = "DELETE FROM $g5[hash_tag_table] WHERE name in (SELECT name FROM $g5[hash_tag_table] 
  JOIN $g5[tag_write_table] ON $g5[tag_write_table].wr_id = $wr_id and $g5[tag_write_table].tag_id = $g5[hash_tag_table].id
  WHERE $g5[hash_tag_table].bo_table = '$bo_table') and $g5[hash_tag_table].bo_table = '$bo_table'";
  sql_query( $sql_table , false );
  $sql_table = "DELETE FROM g5_tag_write WHERE wr_id = $wr_id and bo_table = '$bo_table'";
  sql_query( $sql_table , false );

	foreach( $arrtag as $key => $val ){ 
		$val = trim($val);
    // $wr_id 와 $val 값을 가지고 중복을 체크(중복이 아니면 쓰고, 중복이면 패스)
    // $sql_table = "SELECT count(1) AS flag FROM $g5[hash_tag_table] a 
    //                  JOIN $g5[tag_write_table] b ON b.wr_id = $wr_id and b.tag_id = a.id
    //                  WHERE name = '".$val."' and bo_table = '$bo_table'";
    // $exist = sql_fetch( $sql_table , false );
    // fb($exist);
    // fb('$exist tag', $val);
    // if ($exist['flag'] == '0') {
      $sql_table	=	"INSERT INTO $g5[hash_tag_table] SET bo_table = '$bo_table', name = '".$val."', ip = '{$_SERVER['REMOTE_ADDR']}';";
      sql_query( $sql_table , false );	
      $tag_id = $g5['connect_db']->insert_id;	
      $sql_table = "INSERT INTO $g5[tag_write_table] SET wr_id = $wr_id, tag_id = $tag_id, bo_table = '$bo_table';";
      sql_query( $sql_table , false );	
    // } else {
    //   // 지우는 루틴이 필요 update시에는 
    // }
	}
}

