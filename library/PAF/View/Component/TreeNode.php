<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PAF_View_Component_TreeNode
 * 
 * @property-read string $id Description
 *
 * @author fabrice
 */
class PAF_View_Component_TreeNode implements Iterator
{

    const DEFAULT_CONTENT = 'NODE';
    const RENDER_OUTPUT_PRINT = 'RENDER_OUTPUT_PRINT';
    const RENDER_OUTPUT_RETURN = 'RENDER_OUTPUT_RETURN';

    /**
     *
     * @var string
     */
    protected $_id;

    /**
     *
     * @var string
     */
    public $content;

    /**
     *
     * @var PAF_View_Component_TreeNode[]
     */
    protected $_childNodes;

    public function __construct($content = self::DEFAULT_CONTENT)
    {
        $this->_id = uniqid();
        $this->content = $content;
        $this->_initChildNodes();
    }

    private function _initChildNodes()
    {
        $this->_childNodes = array();
    }

    public function add(PAF_View_Component_TreeNode $node)
    {
        $this->_childNodes[$node->id] = $node;
        return $this;
    }

    public function remove($node)
    {
        if ($node instanceof PAF_View_Component_TreeNode)
        {
            $node = $node->id;
        }

        unset($this->_childNodes[$node]);
    }

    public function free()
    {
        $this->_initChildNodes();
    }

    public function render($outputMode = self::RENDER_OUTPUT_PRINT)
    {
        if (self::RENDER_OUTPUT_RETURN === $outputMode)
        {
            ob_start();
        }
        ?>
        <div class="node">
            <?php $this->_renderFace(); ?>
            <?php $this->_renderChildNodes(); ?>
        </div>
        <?php
        if (self::RENDER_OUTPUT_RETURN === $outputMode)
        {
            return ob_get_clean();
        }
    }

    protected function _renderContent()
    {
        echo $this->content;
    }

    protected function _renderCollapser()
    {
        if (!empty($this->_childNodes)) :
            ?>
            <button type="button" class="btn btn-default" data-toggle="collapse" data-target="#node-<?php echo $this->_id; ?>">+</button>
            <?php
        endif;
    }

    protected function _renderFace()
    {
        ?>
        <div class="front">
            <?php $this->_renderCollapser(); ?>
            <?php $this->_renderContent(); ?>
        </div>
        <?php
    }

    protected function _renderChildNodes()
    {
        if (!empty($this->_childNodes)) :
            ?>
            <div class="collapse in childnodes" id="node-<?php echo $this->_id; ?>">
                <?php
                foreach ($this->_childNodes as $item)
                {
                    $item->render();
                }
                ?>
            </div>
            <?php
        endif;
    }

    public function __get($name)
    {
        switch ($name)
        {
            case 'id':

                return $this->_id;

            default:
                throw new OutOfRangeException('No "' . $name . '" read property');
        }
    }

    public function __toString()
    {
        return $this->render(self::RENDER_OUTPUT_RETURN);
    }

    public function current()
    {
        return current($this->_childNodes);
    }

    public function key()
    {
        return key($this->_childNodes);
    }

    public function next()
    {
        return next($this->_childNodes);
    }

    public function rewind()
    {
        return reset($this->_childNodes);
    }

    public function valid()
    {
        return false !== current($this->_childNodes);
    }

}
