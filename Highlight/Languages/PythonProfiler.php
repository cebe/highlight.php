<?php
/* Copyright (c)
 * - 2006-2013, Brian Beck (exogen@gmail.com), highlight.js (original author)
 * - 2013,      Geert Bergman (geert@scrivo.nl), highlight.php
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 * 1. Redistributions of source code must retain the above copyright notice,
 *    this list of conditions and the following disclaimer.
 * 2. Redistributions in binary form must reproduce the above copyright notice,
 *    this list of conditions and the following disclaimer in the documentation
 *    and/or other materials provided with the distribution.
 * 3. Neither the name of "highlight.js", "highlight.php", nor the names of its
 *    contributors may be used to endorse or promote products derived from this
 *    software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 */

/**
 * This file is a direct port of profile.js, the Python profiler ouput 
 * definition file for highlight.js, to PHP.
 * @see https://github.com/isagalaev/highlight.js
 */
namespace Highlight\Languages;

use Highlight\Language;
use Highlight\Mode;

class PythonProfiler extends Language {
	
	protected function getName() {
		return "profile";
	}
	
	protected function getKeywords() {
		return null;
	}
	
	protected function getContainedModes() {
		
		return array(
			$this->C_NUMBER_MODE,
			new Mode(array(
				"className" => "built_in",
				"begin" => "{", 
				"end" => "}$",
				"excludeBegin" => true, 
				"excludeEnd" => true,
				"contains" => array(
					$this->APOS_STRING_MODE, 
					$this->QUOTE_STRING_MODE
				),
				"relevance" => 0
			)),
			new Mode(array(
				"className" => "filename",
				"begin" => "[a-zA-Z_][\da-zA-Z_]+\.[\da-zA-Z_]{1,3}", 
				"end" => ":",
				"excludeEnd" => true
			)),
			new Mode(array(
				"className" => "header",
				"begin" => "(ncalls|tottime|cumtime)", 
				"end" => "$",
				"keywords" => "ncalls tottime|10 cumtime|10 filename",
				"relevance" => 10
			)),
			new Mode(array(
				"className" => "summary",
				"begin" => "function calls", 
				"end" => "$",
				"contains" => [$this->C_NUMBER_MODE],
				"relevance" => 10
			)),
			$this->APOS_STRING_MODE,
			$this->QUOTE_STRING_MODE,
			new Mode(array(
				"className" => "function",
				"begin" => "\(", 
				"end" => "\)$",
				"contains" => array(
					new Mode(array(
						"className" => "title",
						"begin" => $this->UNDERSCORE_IDENT_RE,
						"relevance" => 0
					))
				),
				"relevance" => 0
			))				
		);

	}

}

?>