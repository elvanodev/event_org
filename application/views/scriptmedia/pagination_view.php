<nav id="pagination">
    <?php if (!empty($links[1])){?>
    <ul class="pagination"><h5 class="btn">Halaman </h5>
<?php foreach ($links as $link) {
echo "<li>". $link."</li>";
} ?> 
  </ul>
    <?php } ?>
</nav>
