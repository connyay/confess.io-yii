<?php
/**
 * Foundation class file.
 * @author Alex Urbano <asgaroth.belem@gmail.com>
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package foundation.widgets
 */

/**
 * Foundation application component.
 * Used for registering Foundation core functionality.
 */
class Foundation extends CApplicationComponent {


    protected $_assetsUrl;

    /**
     * Initializes the component.
     */
    public function init( ) {
        if( !Yii::getPathOfAlias( 'foundation' ) )
            Yii::setPathOfAlias( 'foundation', realpath( dirname( __FILE__ ).'/..' ) );
    }

    /**
     * Returns the URL to the published assets folder.
     * @return string the URL
     */
    protected function getAssetsUrl( ) {
        if( $this->_assetsUrl == null ) {
            $assetsPath = Yii::getPathOfAlias( 'foundation.lib.foundation3' );
            $this->_assetsUrl = Yii::app( )->assetManager->publish( $assetsPath, false, -1, YII_DEBUG );
        }
        return $this->_assetsUrl;
    }

}
