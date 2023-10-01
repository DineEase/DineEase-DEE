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

    <fieldset id="menu-container">

        <!-- The content for each menu option will be loaded here -->
        <div id="appetizers">
            <h2>Appetizers</h2>
            <ul>
                <li>Chicken Wings</li>
                <li>Mozzarella Sticks</li>
                <li>Spinach Dip</li>
            </ul>
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
            <h2>Specials</h2>
            <ul>
                <li>Monday: Burger and Fries</li>
                <li>Tuesday: Taco Salad</li>
                <li>Wednesday: Pizza</li>
            </ul>
        </div>
    </fieldset>