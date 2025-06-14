<?php namespace JATSParser\Body;

class InlineGraphic extends AbstractElement {
    private $href;

    public function __construct(\DOMElement $node) {
        parent::__construct($node);
        foreach ($node->attributes as $attr) {
            error_log('Attr: ' . $attr->nodeName . ' = ' . $attr->nodeValue);
        }
        $this->href = $node->getAttribute('src');
        error_log('DEBUG: displayFullText - Contenido de InlineGraphic: ' . $this->href);

    }

    public function getHref(): string {
        return $this->href;
    }
    public function getContent() {
        return $this->href;
    }
    
    public function toHTML() {
        return '<img src="' . htmlspecialchars($this->href) . '" alt="Inline Graphic" />';
    }
}
