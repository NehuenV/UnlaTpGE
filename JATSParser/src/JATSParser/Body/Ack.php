<?php namespace JATSParser\Body;

use JATSParser\Body\Document as Document;

class Ack extends AbstractElement { // Added by UNLa

	/* @var $title string */ 
	private $title;

	/* @var $ack array */
	private $ack;

	/* @var $content array */
	private $content;

	public function __construct(\DOMElement $ackElement) {
		parent::__construct($ackElement);
		
		$this->title = $this->extractFromElement(".//title", $ackElement);
		$this->ack = $this->extractAuthorNote($ackElement);
		$this->content = $this->extractTitleOrCaption($ackElement, self::JATS_EXTRACT_CAPTION);
	}

	public function getContent(): ?array {
		return $this->content;
	}

	public function getTitle(): ?string {
		return $this->title;
	}

	public function getAck(): ?array {
		return $this->ack;
	}

}
