# Übersicht der Avatarpersonen
Gibt eine Liste aus, welche Avatarpersonen schon vergeben sind. Hierbei ist über das ACP Einstellbar ob mit Divers oder ohne. Zudem kann eingestellt werden, ob die Usernamen formatiert oder nur als Links ausgegeben werden sollen.

## Link
misc.php?action=claims

## neue Templates
- claims 	
- claims_avatars 	
- claims_nav 	
- claims_overview 	
- claims_overview_divers

## variabeln
header
``{$claims_nav}`` 

## neue css 
claims.css

```
.claims_d {  display: grid;
  grid-template-columns: 1fr 1fr 1fr;
  grid-template-rows: min-content min-content max-content min-content max-content min-content max-content min-content max-content min-content max-content min-content max-content;
  gap: 2px 2px;
  grid-auto-flow: row;
  grid-template-areas:
    "claims_female claims_male claims_divers"
    "claims_abcd claims_abcd claims_abcd"
    "claims_f_abcd claims_m_abcd claims_d_abcd"
    "claims_efgh claims_efgh claims_efgh"
    "claims_f_efgh claims_m_efgh claims_d_efgh"
    "claims_ijkl claims_ijkl claims_ijkl"
    "claims_f_ijkl claims_m_ijkl claims_d_ijkl"
    "claims_mnop claims_mnop claims_mnop"
    "claims_f_mnop claims_m_mnop claims_d_mnop"
    "claims_qrst claims_qrst claims_qrst"
    "claims_f_qrst claims_m_qrst claims_d_qrst"
    "claims_uvwxyz claims_uvwxyz claims_uvwxyz"
    "claims_f_uvwxyz claims_m_uvwxyz claims_d_uvwxyz";
}

.claims {
  display: grid; 
  grid-template-columns: 1fr 1fr; 
  grid-template-rows: min-content min-content 1fr min-content 1fr min-content 1fr min-content 1fr min-content 1fr min-content 1fr; 
  gap: 2px 2px; 
  grid-template-areas: 
    "claims_female claims_male"
    "claims_abcd claims_abcd"
    "claims_f_abcd claims_m_abcd"
    "claims_efgh claims_efgh"
    "claims_f_efgh claims_m_efgh"
    "claims_ijkl claims_ijkl"
    "claims_f_ijkl claims_m_ijkl"
    "claims_mnop claims_mnop"
    "claims_f_mnop claims_m_mnop"
    "claims_qrst claims_qrst"
    "claims_f_qrst claims_m_qrst"
    "claims_uvwxyz claims_uvwxyz"
    "claims_f_uvwxyz claims_m_uvwxyz"; 
}

.claims_female { grid-area: claims_female;
background: #0f0f0f url(../../../images/tcat.png) repeat-x;
  color: #fff;
  border-top: 1px solid #444;
  border-bottom: 1px solid #000;
  padding: 7px;
text-align: center;
}

.claims_male { grid-area: claims_male; 
background: #0f0f0f url(../../../images/tcat.png) repeat-x;
  color: #fff;
  border-top: 1px solid #444;
  border-bottom: 1px solid #000;
  padding: 7px;
text-align: center;
}

.claims_divers { grid-area: claims_divers;
background: #0f0f0f url(../../../images/tcat.png) repeat-x;
  color: #fff;
  border-top: 1px solid #444;
  border-bottom: 1px solid #000;
  padding: 7px;
text-align: center;
}

.claims_abcd { grid-area: claims_abcd; 
	background: #ddd;
	color: #333;
	border-bottom: 1px solid #c5c5c5;
	padding: 6px;
	font-size: 12px;
	font-weight: bold;
	text-align: center;
}

.claims_f_abcd { grid-area: claims_f_abcd; 
padding: 5px;
}

.claims_m_abcd { grid-area: claims_m_abcd; 
padding: 5px;
}

.claims_d_abcd { grid-area: claims_d_abcd; 
padding: 5px;
}

.claims_efgh { grid-area: claims_efgh; 	background: #ddd;
	color: #333;
	border-bottom: 1px solid #c5c5c5;
	padding: 6px;
	font-size: 12px;
	font-weight: bold;
	text-align: center;}

.claims_f_efgh { grid-area: claims_f_efgh;
padding: 5px;
 }

.claims_m_efgh { grid-area: claims_m_efgh; 
padding: 5px;
}

.claims_d_efgh { grid-area: claims_d_efgh;
padding: 5px;
 }

.claims_ijkl { grid-area: claims_ijkl; 	background: #ddd;
	color: #333;
	border-bottom: 1px solid #c5c5c5;
	padding: 6px;
	font-size: 12px;
	font-weight: bold;
	text-align: center;}

.claims_f_ijkl { grid-area: claims_f_ijkl; 
padding: 5px;
}

.claims_m_ijkl { grid-area: claims_m_ijkl; 
padding: 5px;
}

.claims_d_ijkl { grid-area: claims_d_ijkl; 
padding: 5px;
}

.claims_mnop { grid-area: claims_mnop; 	background: #ddd;
	color: #333;
	border-bottom: 1px solid #c5c5c5;
	padding: 6px;
	font-size: 12px;
	font-weight: bold;
	text-align: center;}

.claims_f_mnop { grid-area: claims_f_mnop; 
padding: 5px;
}

.claims_m_mnop { grid-area: claims_m_mnop; 
padding: 5px;
}

.claims_d_mnop { grid-area: claims_d_mnop; 
padding: 5px;
}

.claims_qrst { grid-area: claims_qrst; 	background: #ddd;
	color: #333;
	border-bottom: 1px solid #c5c5c5;
	padding: 6px;
	font-size: 12px;
	font-weight: bold;
	text-align: center;}

.claims_f_qrst { grid-area: claims_f_qrst; 
padding: 5px;
}

.claims_m_qrst { grid-area: claims_m_qrst; 
padding: 5px;
}

.claims_d_qrst { grid-area: claims_d_qrst; 
padding: 5px;
}

.claims_uvwxyz { grid-area: claims_uvwxyz;	background: #ddd;
	color: #333;
	border-bottom: 1px solid #c5c5c5;
	padding: 6px;
	font-size: 12px;
	font-weight: bold;
	text-align: center; }

.claims_f_uvwxyz { grid-area: claims_f_uvwxyz; 
padding: 5px;
}

.claims_m_uvwxyz { grid-area: claims_m_uvwxyz; 
padding: 5px;
}

.claims_d_uvwxyz { grid-area: claims_d_uvwxyz; 
padding: 5px;
}


.claims_avatar{
	padding: 2px 2px 2px 10px;	
}

.claims_avatar::before{
	content: ' » ';
	padding-right: 2px;
}
```
