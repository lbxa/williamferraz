<nav>
    <ul class="nav-ul">
        <li class="nav-li"><a href="javascript:delayLinkClick('index.php')">Home</a></li>
        <div class="nav-dropdown">
            <li class="nav-li nav-dropdown-item"><a href="javascript:;">Gallery&nbsp;&nbsp;<i class="fal fa-caret-down"></i></a></li>
            <div class="nav-dropdown-content">
            <?php
                // display nav drop down dynamically
                $cat_data_handler = new Category();
                $cat_data_list = $cat_data_handler->get_all_assoc();
                foreach ($cat_data_list as $key => $value) {
                    // end PHP code block
                ?>
                <li class="nav-li">
                    <a href="javascript:delayLinkClick('gallery.php?cat=<?php echo $cat_data_list[$key]; ?>')"><?php echo ucfirst($cat_data_list[$key]); ?></a>
                </li>
                <?php
                    // continue PHP code block
                    }
                ?>
            </div>
        </div>
        <li class="nav-li"><a href="javascript:delayLinkClick('about.php')">About</a></li>
        <li class="nav-li"><a href="javascript:delayLinkClick('contact.php')">Contact</a></li>
    </ul>
</nav>
