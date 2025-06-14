<?php namespace JATSParser\HTML;

use JATSParser\Body\Ack as JATSAck;
use JATSParser\Body\Par as JATSPar;
use JATSParser\Body\Text as JATSText;
use JATSParser\HTML\Par as Par;
use JATSParser\HTML\Text as HTMLText;

class Ack extends \DOMElement { // Added by UNLa
	public function __construct() {

		parent::__construct("ack");

	}

	public function setContent(JATSAck $ack) {

		$titleNode = $this->ownerDocument->createElement("h2");
		$titleNode->setAttribute("class", "article-section-title");
		$this->appendChild($titleNode);

		/* Set ack paragraph
        * @var $ack JATSAck
        */
		if (count($ack->getAck()) > 0) {
			foreach ($ack->getAck() as $ackNode) {
				$par = new Par("p");
				$this->appendChild($par);
				$par->setContent($ackNode);
			}
		}

		// Set ack label
		if ($ack->getTitle()) {
			$textNode = $this->ownerDocument->createTextNode($ack->getTitle());
			$titleNode->appendChild($textNode);
		}

	}

}
