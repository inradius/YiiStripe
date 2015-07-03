<?php

/**
 * Class LinkPager
 * This is an extension of the Yii CLinkPager class to match bootstraps design.
 *
 * @author Travis Stroud <travis@malameel.com>
 */
class LinkPager extends CLinkPager
{
    const ALIGNMENT_CENTER = 'centered';
    const ALIGNMENT_RIGHT = 'right';

    public $alignment;

    public $header = '';

    public $cssFile = false;

    public $displayFirstAndLast = false;

    public function init()
    {
        if ($this->nextPageLabel === null) {
            $this->nextPageLabel = '&rarr;';
        }

        if ($this->prevPageLabel === null) {
            $this->prevPageLabel = '&larr;';
        }

        $classes = array();

        $validAlignments = array(self::ALIGNMENT_CENTER, self::ALIGNMENT_RIGHT);

        if (in_array($this->alignment, $validAlignments)) {
            $classes[] = 'pagination-' . $this->alignment;
        }

        if (!empty($classes)) {
            $classes = implode(' ', $classes);
            if (isset($this->htmlOptions['class'])) {
                $this->htmlOptions['class'] = ' ' . $classes;
            } else {
                $this->htmlOptions['class'] = $classes;
            }
        }

        parent::init();
    }

    protected function createPageButtons()
    {
        if (($pageCount = $this->getPageCount()) <= 1) {
            return array();
        }

        list ($beginPage, $endPage) = $this->getPageRange();

        $currentPage = $this->getCurrentPage(false); // currentPage is calculated in getPageRange()

        $buttons = array();

        if ($this->displayFirstAndLast) {
            $buttons[] = $this->createPageButton($this->firstPageLabel, 0, 'first', $currentPage <= 0, false);
        }

        if (($page = $currentPage - 1) < 0) {
            $page = 0;
        }

        $buttons[] = $this->createPageButton($this->prevPageLabel, $page, 'previous', $currentPage <= 0, false);

        for ($i = $beginPage; $i <= $endPage; ++$i) {
            $buttons[] = $this->createPageButton($i + 1, $i, '', false, $i == $currentPage);
        }

        if (($page = $currentPage + 1) >= $pageCount - 1) {
            $page = $pageCount - 1;
        }

        $buttons[] = $this->createPageButton(
            $this->nextPageLabel,
            $page,
            'next',
            $currentPage >= ($pageCount - 1),
            false
        );

        if ($this->displayFirstAndLast) {
            $buttons[] = $this->createPageButton(
                $this->lastPageLabel,
                $pageCount - 1,
                'last',
                $currentPage >= ($pageCount - 1),
                false
            );
        }

        return $buttons;
    }

    protected function createPageButton($label, $page, $class, $hidden, $selected)
    {
        if ($hidden || $selected) {
            $class .= ' ' . ($hidden ? 'disabled' : 'active');
        }

        return CHtml::tag('li', array('class' => $class), CHtml::link($label, $this->createPageUrl($page)));
    }
}