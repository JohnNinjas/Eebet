<?php
/**
 * Created by PhpStorm.
 * User: soska_report
 * Date: 26.11.2019
 * Time: 12:59
 */


namespace backend\components;

use yii\imagine\Image;

class ForecastImages
{
    public static function doResize($imageLocation, $imageDestination, Array $options = null)
    {
        $newWidth = $newHeight = 0;
        list($width, $height) = getimagesize($imageLocation);

        if (isset($options['newWidth']) || isset($options['newHeight'])) {
            if (isset($options['newWidth']) && isset($options['newHeight'])) {
                $newWidth = $options['newWidth'];
                $newHeight = $options['newHeight'];
            } else if (isset($options['newWidth'])) {
                $deviationPercentage = (($width - $options['newWidth']) / (0.01 * $width)) / 100;

                $newWidth = $options['newWidth'];
                $newHeight = $height - ($height * $deviationPercentage);
            } else {
                $deviationPercentage = (($height - $options['newHeight']) / (0.01 * $height)) / 100;

                $newWidth = $width - ($width * $deviationPercentage);
                $newHeight = $options['newHeight'];
            }
        } else {
            // reduce image size up to 20% by default
            $reduceRatio = isset($options['reduceRatio']) ? $options['reduceRatio'] : 20;

            $newWidth = $width * ((100 - $reduceRatio) / 100);
            $newHeight = $height * ((100 - $reduceRatio) / 100);
        }

        return Image::thumbnail(
            $imageLocation,
            (int)$newWidth,
            (int)$newHeight
        )->save(
            $imageDestination,
            ['quality' => isset($options['quality']) ? $options['quality'] : 100]
        );
    }
}

