<?php namespace JATSParser\Body;

use JATSParser\Body\JATSElement as JATSElement;
use JATSParser\Body\Text as Text;
use JATSParser\Body\Par as Par;

class Cell extends AbstractElement {

	/* @var array Can contain Par and Text */
	private $content = array();

	/* @var $type string  */
	private $type;

	/* @var $colspan int  */
	private $colspan;

	/* @var $rowspan int  */
	private $rowspan;

	// Added by UNLa
	/* @var $style string  */
	private $style;

	// Added by UNLa
	/* @var $align string  */
	private $align;

	function __construct(\DOMElement $cellNode) {
		parent::__construct($cellNode);
		
		$this->type = $cellNode->nodeName;
		$content = array();
		$xpath = Document::getXpath();
		$childNodes = $xpath->query("child::node()", $cellNode);
		foreach ($childNodes as $childNode) {
			if ($childNode->nodeName === 'img') {
				$inlineGraphic = new InlineGraphic($childNode);
				$content[] = $inlineGraphic;
			}else  if ($childNode->nodeName === "p") {
				$par = new Par($childNode);
				$content[] = $par;
			} else {
				$jatsTextNodes = $xpath->query(".//self::text()", $childNode);
				foreach ($jatsTextNodes as $jatsTextNode){
					$jatsText = new Text($jatsTextNode);
					$content[] = $jatsText;
				}
			}
		}

		$this->content = $content;

		$cellNode->hasAttribute("colspan") ? $this->colspan = $cellNode->getAttribute("colspan") : $this->colspan = 1;

		$cellNode->hasAttribute("rowspan") ? $this->rowspan = $cellNode->getAttribute("rowspan") : $this->rowspan = 1;

		$cellNode->hasAttribute("style") ? $this->style = $cellNode->getAttribute("style"): $this->style = ""; // Added by UNLa

		$cellNode->hasAttribute("align") ? $this->align = $cellNode->getAttribute("align") : $this->align = "left"; // Added by UNLa

	}

	/**
	 * @return array
	 */

	public function getContent(): array {
		return $this->content;
	}

	/**
	 * @return string
	 */

	public function getType(): string {
		return $this->type;
	}

	/**
	 * @return int
	 */
	public function getColspan(): int
	{
		return $this->colspan;
	}

	/**
	 * @return int
	 */
	public function getRowspan(): int
	{
		return $this->rowspan;
	}

	/**
	 * @return string
	 */
	public function getStyle(): string // Added by UNLa
	{
		return $this->style;
	}

	/**
	 * @return string
	 */
	public function getAlign(): string // Added by UNLa
	{
		return $this->align;
	}
}
