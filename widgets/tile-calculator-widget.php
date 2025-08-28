<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class Tile_Calculator_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'tile_calculator';
    }

    public function get_title() {
        return __( 'Tile Calculator', 'tile-calculator' );
    }

    public function get_icon() {
        // Google icon using Font Awesome Brands
        return 'fa-solid fa-calculator';
    }

    public function get_categories() {
        return [ 'general' ];
    }

    public function get_script_depends() {
        return [ 'tile-calculator-js' ];
    }

    public function get_style_depends() {
        return [ 'tile-calculator-css' ];
    }

    public function render() {
        ?>
        <div class="tc-container">
            <div class="tc-form">
                <h3>Room / Space Type</h3>
                <select id="room-type">
                    <option value="">Select Room</option>
                    <option value="Kitchen">Kitchen</option>
                    <option value="Bathroom">Bathroom</option>
                </select>

                <select id="space-type">
                    <option value="">Select Space</option>
                    <option value="Wall">Wall</option>
                    <option value="Floor">Floor</option>
                </select>

                <h3>Area To Be Covered</h3>
                <label><input type="radio" name="area-option" value="dimensions" checked> Use Dimensions</label>
                <label><input type="radio" name="area-option" value="total"> Use Total Area</label>

                <div class="dimension-fields">
                    <input type="number" id="length-feet" placeholder="Length (ft)">
                    <input type="number" id="length-inch" placeholder="Length (in)">
                    <input type="number" id="width-feet" placeholder="Width (ft)">
                    <input type="number" id="width-inch" placeholder="Width (in)">
                </div>

                <div class="total-area-field" style="display:none;">
                    <input type="number" id="total-area-input" placeholder="Total Area (sq.ft)">
                </div>

                <select id="tile-size">
                    <option value="">Select Tile Size</option>
                    <option value="12x12">12 x 12 in</option>
                    <option value="24x24">24 x 24 in</option>
                </select>

                <label><input type="checkbox" id="add-waste"> Add waste and reserve material (10%)</label>
                <label><input type="checkbox" id="add-grout"> Add Grout Width (mm)</label>

                <div class="tc-buttons">
                    <button type="button" class="tc-calculate">Calculate</button>
                </div>
            </div>

            <div class="tc-result">
                <h4 id="result-room">Room</h4>
                <p>Total Tiles: <span id="total-tiles">0</span></p>
                <p>Total Area: <span id="total-area">0.00</span> sq.ft.</p>
            </div>
        </div>
        <?php
    }
}

// JS & CSS enqueue
add_action( 'wp_enqueue_scripts', function() {
    wp_register_script( 'tile-calculator-js', plugins_url( 'tile-calculator.js', __FILE__ ), [ 'jquery' ], '1.0', true );
    wp_register_style( 'tile-calculator-css', plugins_url( 'tile-calculator.css', __FILE__ ) );
});
