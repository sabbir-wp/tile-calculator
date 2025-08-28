jQuery(document).ready(function($) {
    // Switch between dimensions & total area
    $('input[name="area-option"]').change(function() {
        if ($(this).val() === 'dimensions') {
            $('.dimension-fields').show();
            $('.total-area-field').hide();
        } else {
            $('.dimension-fields').hide();
            $('.total-area-field').show();
        }
    });

    $('.tc-calculate').on('click', function() {
        let totalArea = 0;

        if ($('input[name="area-option"]:checked').val() === 'dimensions') {
            let lengthFt = parseFloat($('#length-feet').val()) || 0;
            let lengthIn = parseFloat($('#length-inch').val()) || 0;
            let widthFt  = parseFloat($('#width-feet').val()) || 0;
            let widthIn  = parseFloat($('#width-inch').val()) || 0;

            let lengthTotal = lengthFt + (lengthIn / 12);
            let widthTotal  = widthFt + (widthIn / 12);

            totalArea = lengthTotal * widthTotal;
        } else {
            totalArea = parseFloat($('#total-area-input').val()) || 0;
        }

        let tileSize = $('#tile-size').val();
        let tileArea = 0;

        if (tileSize === '12x12') {
            tileArea = 1; // 1 sq.ft
        } else if (tileSize === '24x24') {
            tileArea = 4; // 4 sq.ft
        }

        // Grout adds ~0.1 inches to each side
        if ($('#add-grout').is(':checked')) {
            if (tileSize === '12x12') tileArea = (12.1/12) * (12.1/12);
            if (tileSize === '24x24') tileArea = (24.1/12) * (24.1/12);
        }

        let totalTiles = tileArea > 0 ? totalArea / tileArea : 0;

        if ($('#add-waste').is(':checked')) {
            totalTiles *= 1.10; // add 10% waste
        }

        // Update results
        $('#result-room').text($('#room-type').val() || 'Room');
        $('#total-area').text(totalArea.toFixed(2));
        $('#total-tiles').text(Math.ceil(totalTiles));
    });
});
