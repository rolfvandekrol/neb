<?php

/*
comments blocks
changes the span to <time> adds a datetime
changes the item-list class to item-list-comments
*/
function mothership_comment_block() {
  $items = array();
  $number = variable_get('comment_block_count', 10);

  foreach (comment_get_recent($number) as $comment) {
    //kpr($comment->changed);
    //print date('Y-m-d H:i', $comment->changed);
    $items[] =
    l($comment->subject, 'comment/' . $comment->cid, array('fragment' => 'comment-' . $comment->cid)) .
    ' <time datetime="'.date('Y-m-d H:i', $comment->changed).'">' . t('@time ago', array('@time' => format_interval(REQUEST_TIME - $comment->changed))) . '</time>';
  }

  if ($items) {
    return theme('item_list', array('items' => $items, 'daddy' => 'comments'));
  }
  else {
    return t('No comments available.');
  }
}