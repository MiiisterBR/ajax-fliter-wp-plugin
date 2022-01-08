<?php
global $post;

//get post data
$values                  = get_post_custom( $post->ID );

//validate and check input
$house_features_floor    = isset( $values['house_features_floor'] ) ? esc_attr( $values['house_features_floor'][0] ) : '';
$house_features_bedroom  = isset( $values['house_features_bedroom'] ) ? esc_attr( $values['house_features_bedroom'][0] ) : '';
$house_features_parking  = isset( $values['house_features_parking'] ) ? esc_attr( $values['house_features_parking'][0] ) : '';
$house_features_elevator = isset( $values['house_features_elevator'] ) ? esc_attr( $values['house_features_elevator'][0] ) : '';

//this nonce field when saving.
wp_nonce_field( 'house_features_meta_box_nonce', 'meta_box_nonce' );
?>
<p>
    <label for="house_features_floor">Floor</label>
    <select name="house_features_floor" id="house_features_floor">
        <option selected value="first" <?php selected( $house_features_floor, 'first' ); ?>>first</option>
        <option value="second" <?php selected( $house_features_floor, 'second' ); ?>>second</option>
        <option value="third" <?php selected( $house_features_floor, 'third' ); ?>>third</option>
        <option value="fourth" <?php selected( $house_features_floor, 'fourth' ); ?>>fourth</option>
    </select>
</p>

<p>
    <label for="house_features_bedroom">Bed room</label>
    <select name="house_features_bedroom" id="house_features_bedroom">
        <option selected value="one" <?php selected( $house_features_bedroom, 'one' ); ?>>one</option>
        <option value="two" <?php selected( $house_features_bedroom, 'two' ); ?>>two</option>
        <option value="three" <?php selected( $house_features_bedroom, 'three' ); ?>>three</option>
    </select>
</p>
<p>
    <input type="checkbox" id="house_features_parking"
           name="house_features_parking" <?php checked( $house_features_parking, 'on' ); ?> />
    <label for="my_meta_box_check">Parking</label>
</p>
<p>
    <input type="checkbox" id="house_features_elevator"
           name="house_features_elevator" <?php checked( $house_features_elevator, 'on' ); ?> />
    <label for="my_meta_box_check">Elevator</label>
</p>
