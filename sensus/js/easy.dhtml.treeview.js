// ---------------------------------------------
// --- Name:    Easy DHTML Treeview           --
// --- Author:  D.D. de Kerf                  --
// --- Version: 0.2          Date: 13-6-2001  --
// ---------------------------------------------
function ToggleNode(nodeChild)
{
	var node = (nodeChild.parentNode);
	// Unfold the branch if it isn't visible
	if (node.nextSibling.style.display == 'none')
	{
		// Change the image (if there is an image)
		if (node.childNodes.length > 0)
		{
			if (node.childNodes.item(0).nodeName == "IMG")
			{
				node.childNodes.item(0).src = node.childNodes.item(0).src.replace(/plus/,'minus');
			}
		}

		node.nextSibling.style.display = 'block';
	}
	// Collapse the branch if it IS visible
	else
	{
		// Change the image (if there is an image)
		if (node.childNodes.length > 0)
		{
			if (node.childNodes.item(0).nodeName == "IMG")
			{
				node.childNodes.item(0).src = node.childNodes.item(0).src.replace(/minus/,'plus');
			}
		}

		node.nextSibling.style.display = 'none';
	}
	window.top.resizeIframe();
}