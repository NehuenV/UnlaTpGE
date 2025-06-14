<?php namespace JATSParser\Body;

use JATSParser\Body\Document as Document;

class AuthorNote extends AbstractElement { // Class added by UNLa

	/* @var $label string */
	private $label;

	/* @var $authorNote array */
	private $authorNote;

	/* @var $content array */
	private $content;

	public function __construct(\DOMElement $authorNoteElement) {
		parent::__construct($authorNoteElement);

		$this->label = $this->extractFromElement(".//label", $authorNoteElement);
		$this->authorNote = $this->extractAuthorNote($authorNoteElement);
		$this->content = $this->extractTitleOrCaption($authorNoteElement, self::JATS_EXTRACT_CAPTION);

	}

	public function getContent(): ?array {
		return $this->content;
	}

	public function getLabel(): ?string {
		return $this->label;
	}

	public function getAuthorNote(): ?array {
		return $this->authorNote;
	}

}
