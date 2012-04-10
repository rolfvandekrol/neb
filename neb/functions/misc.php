<?php


function theme_nomarkup($variables) {
  $output = '';
  // Render the items.
  foreach ($variables['items'] as $delta => $item) {
    $output .=  drupal_render($item);
  }

  return $output;
}

function neb_comment_block() {
  $items = array();
  $number = variable_get('comment_block_count', 10);

  foreach (comment_get_recent($number) as $comment) {
    //kpr($comment->changed);
    //print date('Y-m-d H:i', $comment->changed);
    $items[] =
    '<h3>' . l($comment->subject, 'comment/' . $comment->cid, array('fragment' => 'comment-' . $comment->cid)) . '</h3>' .
    ' <time datetime="'.date('Y-m-d H:i', $comment->changed).'">' . t('@time ago', array('@time' => format_interval(REQUEST_TIME - $comment->changed))) . '</time>';
  }

  if ($items) {
    return theme('item_list', array('items' => $items, 'daddy' => 'comments'));
  }
  else {
    return t('No comments available.');
  }
}

