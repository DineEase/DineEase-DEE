<div>
    <div class="search-menu">
        <div class="group-search">
            <svg class="icon-search" aria-hidden="true" viewBox="0 0 24 24">
                <g>
                    <path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"></path>
                </g>
            </svg>
            <input placeholder="Search" type="search" class="input-search   ">
        </div>
    </div>
    <div class="menu-radio-inputs">
        <label class="radio">
            <input type="radio" name="menu" value="all" checked="">
            <span class="name">All</span>
        </label>
        <label class="radio">
            <input type="radio" name="menu" value="entrees">
            <span class="name">Entrees</span>
        </label>

        <label class="radio">
            <input type="radio" name="menu" value="desserts">
            <span class="name">Dessers</span>
        </label>
        <label class="radio">
            <input type="radio" name="menu" value="drinks">
            <span class="name">Drinks</span>
        </label><label class="radio">
            <input type="radio" name="menu" value="specials">
            <span class="name">Specials</span>
        </label>
    </div>
</div>
<fieldset id="menu-container">

    <!-- The content for each menu option will be loaded here -->
    <div id="appetizers">
        <div class="menu-item-row">
            <?php
            for ($i = 0; $i < 14; $i++) {
                echo '<div class="menu-item-card">';
                echo '<div class="menu-item-image">';
                echo '<img src="./biriyani.jpg" alt="" />';
                echo '</div>';
                echo '<div class="menu-item-details">';
                echo '<div class="name">Chicken Biriyani large</div>';
                echo '<div class="tags-reviews">';
                echo '<div class="tags">';
                echo '<div class="tags">Spicy</div>';
                echo '</div>';
                echo '<div class="reviews">';
                echo '<span>4.5<i class="fa-star" style="color: rgb(0, 255, 17)"></i></span>';
                echo '</div>';
                echo '</div>';
                echo '<div class="price">Rs.1200.00</div>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
        <div class="pagination pagination-menu">

            <a href="#"><i class="fas fa-angle-double-left fa-sm"></i></a>
            <a href="#"><i class="fas fa-angle-double-right fa-sm"></i></a>
        </div>
    </div>
    <div id="entrees" style="display:none;">
        <h2>Entrees</h2>
        <ul>
            <li>Steak</li>
            <li>Salmon</li>
            <li>Chicken Alfredo</li>
        </ul>
    </div>
    <div id="desserts" style="display:none;">
        <h2>Desserts</h2>
        <ul>
            <li>Chocolate Cake</li>
            <li>Apple Pie</li>
            <li>Ice Cream Sundae</li>
        </ul>
    </div>
    <div id="drinks" style="display:none;">
        <h2>Drinks</h2>
        <ul>
            <li>Soda</li>
            <li>Beer</li>
            <li>Wine</li>
        </ul>
    </div>
    <div id="specials" style="display:none;">
        <div class="menu-item-row">
            <div class="menu-item-card">
                <div class="menu-item-card2">
                    <div class="rectangle-391"></div>
                    <div class="group-3143">
                        <div class="rectangle-390">
                            <img class="item-image" src="./biriyani.jpg" />
                        </div>

                    </div>
                    <div class="item-content">
                        <div class="chicken-biryani">Chicken Biryani</div>
                        <div class="tags">
                            <div class="frame-3181">
                                <div class="frame-3179">
                                    <svg class="vector" width="8" height="9" viewBox="0 0 8 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7.97913 3.72965C7.92676 3.56061 7.78308 3.44055 7.61309 3.42457L5.30408 3.20579L4.39103 0.975766C4.32371 0.812334 4.17039 0.706543 4.00003 0.706543C3.82968 0.706543 3.67636 0.812334 3.60903 0.976148L2.69599 3.20579L0.386605 3.42457C0.216923 3.44093 0.0736091 3.56061 0.0209345 3.72965C-0.03174 3.89868 0.0169061 4.08409 0.145266 4.20096L1.89061 5.79821L1.37595 8.16389C1.33829 8.33783 1.40299 8.51763 1.5413 8.62196C1.61564 8.67801 1.70261 8.70654 1.79032 8.70654C1.86595 8.70654 1.94096 8.68527 2.00829 8.64323L4.00003 7.40106L5.99105 8.64323C6.13674 8.73469 6.3204 8.72635 6.4584 8.62196C6.59677 8.51732 6.66141 8.33745 6.62375 8.16389L6.10909 5.79821L7.85443 4.20128C7.98279 4.08409 8.0318 3.899 7.97913 3.72965V3.72965Z" fill="#32B768" />
                                    </svg>

                                    <div class="_4-5">4.5</div>
                                </div>
                            </div>
                            <div class="line-68"></div>
                            <div class="frame-3183">
                                <div class="frame-3179">
                                    <div class="special">Special</div>
                                </div>
                            </div>
                        </div>
                        <div class="item-price">
                            <svg class="vector2" width="19" height="13" viewBox="0 0 19 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.5 0.206543H18.5V12.2065H0.5V0.206543ZM9.5 3.20654C10.2956 3.20654 11.0587 3.52261 11.6213 4.08522C12.1839 4.64783 12.5 5.41089 12.5 6.20654C12.5 7.00219 12.1839 7.76525 11.6213 8.32786C11.0587 8.89047 10.2956 9.20654 9.5 9.20654C8.70435 9.20654 7.94129 8.89047 7.37868 8.32786C6.81607 7.76525 6.5 7.00219 6.5 6.20654C6.5 5.41089 6.81607 4.64783 7.37868 4.08522C7.94129 3.52261 8.70435 3.20654 9.5 3.20654ZM4.5 2.20654C4.5 2.73698 4.28929 3.24568 3.91421 3.62076C3.53914 3.99583 3.03043 4.20654 2.5 4.20654V8.20654C3.03043 8.20654 3.53914 8.41726 3.91421 8.79233C4.28929 9.1674 4.5 9.67611 4.5 10.2065H14.5C14.5 9.67611 14.7107 9.1674 15.0858 8.79233C15.4609 8.41726 15.9696 8.20654 16.5 8.20654V4.20654C15.9696 4.20654 15.4609 3.99583 15.0858 3.62076C14.7107 3.24568 14.5 2.73698 14.5 2.20654H4.5Z" fill="#32B768" />
                            </svg>
                            <div class="rs-1200-00">Rs.1200.00</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</fieldset>