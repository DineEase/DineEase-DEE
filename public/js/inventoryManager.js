document.getElementById('viewsTab').addEventListener('click', function() {
    document.getElementById('viewsContent').style.display = 'block';
    document.getElementById('statsContent').style.display = 'none';
});

document.getElementById('statsTab').addEventListener('click', function() {
    document.getElementById('viewsContent').style.display = 'none';
    document.getElementById('statsContent').style.display = 'block';
});

document.addEventListener('DOMContentLoaded', function() {
    var manageCategoryButton = document.getElementById('manageCategoryButton');
    manageCategoryButton.addEventListener('click', function() {
        openForm();
    });
});
function searchFunction() {
    // Add your search functionality here
    console.log("Search button clicked");
}

function addCategory() {
            // Add category functionality
            var input = document.getElementById('newCategoryInput').value;
            var ul = document.getElementById('categoriesList');
            var li = document.createElement('li');
            li.appendChild(document.createTextNode(input));
            ul.appendChild(li);
        }

        function editCategory() {
            // Edit category functionality
            // Add your edit category code here
            
        };
        categories[i].addEventListener('blur', function () {
            this.setAttribute('contenteditable', 'false');
        });
        function deleteCategory() {
            // Delete category functionality
            // Add your delete category code here
        }

        function closeForm() {
            // Close form functionality
            document.getElementById('categoriesForm').style.display = 'none';
        }

        function openForm() {
            // Open form functionality
            document.getElementById('categoriesForm').style.display = 'block';
        }
        document.addEventListener('DOMContentLoaded', function() {
    var manageCategoryButton = document.querySelector('#manageCategoryButton');
    manageCategoryButton.addEventListener('click', function() {
        openForm();
    });
});

document.addEventListener('DOMContentLoaded', function() {
    // Your JavaScript code
});

function search() {
    // Search functionality
}

function printGraphs() {
    // Print functionality
}

function exportGraphs() {
    // Export functionality
}

document.addEventListener('DOMContentLoaded', function() {
    openTab(event, 'tab1'); // Open the first tab by default
});

function openTab(evt, tabName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName('tabcontent2');
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = 'none';
    }
    document.getElementById(tabName).style.display = 'block';
}

function saveForm() {
    // Save form functionality
}

function closeForm() {
    // Close form functionality
}

function deleteForm() {
    // Delete form functionality
}