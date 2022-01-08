<form action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="POST" id="filter">
    <input type="hidden" name="action" value="house_filter_data">
    <label for="house_features_floor">Floor</label>
    <select name="house_features_floor" id="house_features_floor">
        <option value="" selected>Select Item</option>
        <option value="first">first</option>
        <option value="second">second</option>
        <option value="third">third</option>
        <option value="fourth">fourth</option>
    </select>
    <label for="house_features_bedroom">Bed room</label>
    <select name="house_features_bedroom" id="house_features_bedroom">
        <option value="" selected>Select Item</option>
        <option value="one">one</option>
        <option value="two">two</option>
        <option value="three">three</option>
    </select>

    <input type="checkbox" id="house_features_parking"
           name="house_features_parking"/>
    <label for="my_meta_box_check">Parking</label>

    <input type="checkbox" id="house_features_elevator"
           name="house_features_elevator"/>
    <label for="my_meta_box_check">Elevator</label>
    <button type="submit" id="house_filter_ajax">Apply filter</button>
</form>
