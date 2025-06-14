<?php namespace JATSParser\HTML;

use JATSParser\Body\AuthorNote as JATSAuthorNote;
use JATSParser\Body\Par as JATSPar;
use JATSParser\Body\Text as JATSText;
use JATSParser\HTML\Par as Par;
use JATSParser\HTML\Text as HTMLText;

class AuthorNote extends \DOMElement { // Adeed by UNLa
	public function __construct() {

		parent::__construct("fn");

	}

	public function setContent(JATSAuthorNote $authorNote) {

		$titleNode = $this->ownerDocument->createElement("h2");
		$titleNode->setAttribute("class", "article-section-title");
		$this->appendChild($titleNode);

		/* Set author paragraph
        * @var $authorNote JATSAuthorNote
        */
		if (count($authorNote->getAuthorNote()) > 0) {
			foreach ($authorNote->getAuthorNote() as $authorNode) {
				$par = new Par("p");
				$this->appendChild($par);
				$par->setContent($authorNode);
			}
		}

		// Set author note label
		if ($authorNote->getLabel()) {
			$textNode = $this->ownerDocument->createTextNode($authorNote->getLabel());
			$titleNode->appendChild($textNode);
		}

	}

}
