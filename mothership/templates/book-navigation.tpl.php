<?php if ($tree || $has_links): ?>
  <nav id="book-navigation-<?php print $book_id; ?>" class="book-navigation">
    <?php print $tree; ?>
    <?php if ($has_links): ?>
      <h2 class="element-invisible"><?php print t('Book Navigation'); ?></h2>
      <ul class="book-pager">
      <?php if ($prev_url): ?>
        <li class="previous">
          <a href="<?php print $prev_url; ?>" rel="prev" title="<?php print t('Go to previous page'); ?>"><b><?php print t('‹'); ?></b> <?php print $prev_title; ?></a>
        </li>
      <?php endif; ?>
      <?php if ($parent_url): ?>
        <li class="up">
          <a href="<?php print $parent_url; ?>" title="<?php print t('Go to parent page'); ?>"><b>^</b><?php print t('up'); ?></a>
        </li>
      <?php endif; ?>
      <?php if ($next_url): ?>
        <li class="next">
          <a href="<?php print $next_url; ?>" rel="next" title="<?php print t('Go to next page'); ?>"><?php print $next_title;?> <b><?php print t('›'); ?></b></a>
        </li>
      <?php endif; ?>
    </ul>
    <?php endif; ?>
  </nav>
<?php endif; ?>