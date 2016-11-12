<?php 

class htmlElement{
	
	private $accesskey;
	private $class;
	private $contenteditable;
	private $contextmenu;
	private $data;
	private $dir;
	private $draggable;
	private $dropzone;
	private $hidden;
	private $id;
	private $lang			= 'fr';
	private $spellcheck;
	private $style;
	private $tabindex;
	private $title;
	private $translate;
	
	function __construct(){}
	
	/**
	 * Affecte une valeur � l'attribut accesskey
	 * D�finition W3C : Specifies a shortcut key to activate/focus an element
	 * @param string $accesskey
	 * @return htmlElement
	 */
	public function setAccessKey($accesskey){
		$this->accesskey = $accesskey;
		return $this;
	}
	/**
	 * Affecte une ou plusieurs valeurs � l'attribut class
	 * D�finition W3C : Specifies one or more classnames for an element (refers to a class in a style sheet)
	 * @param string|array $classes Une classe ou un tableau de classes
	 * @return htmlElement
	 */
	public function setClasses($classes){
		assert('is_array($classes) || is_string($classes)');
		if ($classes === '') {
            $classes = array();
        } elseif (is_string($classes)) {
            $classes = explode(' ', $classes);
        }
        if (is_array($classes)) {
        	array_unique($classes);
            $this->class = $classes;
        }
        return $this;
	}
	
	/**
	 * Affecte une valeur � l'attribut contentEditable (true ou false)
	 * D�finition W3C : Specifies whether the content of an element is editable or not
	 * @param boolean $contenteditable
	 * @return htmlElement
	 */
	public function setContentEditable($contenteditable){
		$this->contenteditable = $contenteditable;
		return $this;
	}
	
	/**
	 * Affecte une valeur � l'attribut contextmenu
	 * D�finition W3C : Specifies a context menu for an element. The context menu appears when a user right-clicks on the element
	 * @param string $contextMenu (r�f�rence � un attribut id)
	 * @return htmlElement
	 */
	public function setContextMenu($contextMenu){
		$this->contextmenu = $contextMenu;
		return $this;
	}
	
	/**
	 * Affecte une ou plusieurs valeurs � l'attribut data
	 * D�finition W3C : Used to store custom data private to the page or application
	 * @param string|array $data Une data ou un tableau de data
	 * @return htmlElement
	 */
	public function setData($data){
		assert('is_array($data) || is_string($data)');
		if ($data === '') {
            $data = array();
        } elseif (is_string($data)) {
            $data = explode(' ', $data);
        }
        if (is_array($data)) {
        	array_unique($data);
            $this->data = $data;
        }
        return $this;
	}
	
	/**
	 * Affecte une valeur � l'attribut dir
	 * D�finition W3C : Specifies the text direction for the content in an element
	 * @param string $dir
	 * @return htmlElement
	 */
	public function setDir($dir){
		$this->dir = $dir;
		return $this;
	}
	
	/**
	 * Affecte une valeur � l'attribut draggable (true ou false)
	 * D�finition W3C : Specifies whether an element is draggable or not
	 * @param string $draggable
	 * @return htmlElement
	 */
	public function setDraggable($draggable){
		$this->draggable = $draggable;
		return $this;
	}
	
	/**
	 * Affecte une valeur � l'attribut dropzone
	 * D�finition W3C : Specifies whether the dragged data is copied, moved, or linked, when dropped
	 * @param string $dropzone
	 * @return htmlElement
	 */
	public function setDropzone($dropzone){
		$this->dropzone = $dropzone;
		return $this;
	}
	
	/**
	 * Affecte une valeur � l'attribut hidden
	 * D�finition W3C : Specifies that an element is not yet, or is no longer, relevant
	 * @param boolean $hidden
	 * @return htmlElement
	 */
	public function setHidden($hidden){
		$this->hidden = $hidden;
		return $this;
	}
	
	/**
	 * Affecte une ou plusieurs valeurs � l'attribut id
	 * D�finition W3C : Specifies a unique id for an element
	 * @param string | array $ids
	 * @return htmlElement
	 */
	public function setIds($ids){
		assert('is_array($ids) || is_string($ids)');
		if ($ids === '') {
            $ids = array();
        } elseif (is_string($ids)) {
            $ids = explode(' ', $ids);
        }
        if (is_array($ids)) {
        	array_unique($ids);
            $this->id = $ids;
        }
        return $this;
	}
	
	/**
	 * Affecte une valeur � l'attribut lang
	 * D�finition W3C : Specifies the language of the element's content
	 * @param string $lang
	 * @return htmlElement
	 */
	public function setLang($lang){
		$this->lang = $lang;
		return $this;
	}
	
	/**
	 * Affecte une valeur � l'attribut lang
	 * D�finition W3C : Specifies whether the element is to have its spelling and grammar checked or not
	 * @param boolean $spellcheck
	 * @return htmlElement
	 */
	public function setSpellcheck($spellcheck){
		$this->spellcheck = $spellcheck;
		return $this;
	}
	
	/**
	 * Affecte une valeur � l'attribut style
	 * D�finition W3C : Specifies an inline CSS style for an element
	 * @param string $style
	 * @return htmlElement
	 */
	public function setStyle($style){
		$this->style = $style;
		return $this;
	}
	
	/**
	 * Affecte une valeur � l'attribut tabindex
	 * D�finition W3C : Specifies the tabbing order of an element
	 * @param int $tabindex
	 * @return htmlElement
	 */
	public function setTabindex($tabindex){
		$this->tabindex = $tabindex;
		return $this;
	}
	
	/**
	 * Affecte une valeur � l'attribut title
	 * D�finition W3C : Specifies extra information about an element
	 * @param string $title
	 * @return htmlElement
	 */
	public function setTitle($title){
		$this->title = $title;
		return $this;
	}
	
	/**
	 * Affecte une valeur � l'attribut title (yes ou no)
	 * D�finition W3C :	Specifies whether the content of an element should be translated or not
	 * @param string $translate
	 * @return htmlElement
	 */
	public function setTranslate($translate){
		$this->translate = $translate;
		return $this;
	}
	
	
}

?>