<?php
/**
 * This file handles the function for displaying a list of ideas.
 *
 * @package Ideas
 * @author Isfandiyar Akhmedbayev
 */

/**
 * Function to display a list of ideas with pagination.
 *
 * @param mysqli $connection The database connection object.
 * @param string $type The type of ideas to display. Can be 'my_ideas', 'all_ideas', or 'viewed_ideas'.
 *
 * @return void The function does not return a value but echoes HTML links to the ideas and pagination controls.
 */
function pagination($connection, $type) {
    $currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $ideasOnPage = 7;
    if ($type == 'my_ideas') {
        $username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
        $sql = "SELECT * FROM `ideas` WHERE username = '$username'";
    } else if ($type == 'all_ideas') {
        $sql = "SELECT id, title FROM ideas";
    } else if ($type == 'viewed_ideas') {
        if (isset($_SESSION['viewed_ideas']) && is_array($_SESSION['viewed_ideas'])) {
            $viewed_ideas = $_SESSION['viewed_ideas'];
        } else {
            $viewed_ideas = [];
        }

        $totalIdeas = count($viewed_ideas);
        if ($totalIdeas == 0) {
            echo "<span class='nothing'>NOTHING</span>";
            return;
        }

        $totalPages = ceil($totalIdeas / $ideasOnPage);

        if ($currentPage > $totalPages) {
            $currentPage = $totalPages;
        }
        if ($currentPage < 1) {
            $currentPage = 1;
        }

        $startIndex = ($currentPage - 1) * $ideasOnPage;
        $ideasForCurrentPage = array_slice($viewed_ideas, $startIndex, $ideasOnPage);

        echo '<ul>';
        foreach($ideasForCurrentPage as $idea) {
            if (is_array($idea) && isset($idea['id']) && isset($idea['title'])) {
                echo '<li>'.htmlspecialchars($idea['title']).'</li>';
            }
        }
        echo '</ul>';

        echo '<div class="numbers">';
        for ($i = 1; $i <= $totalPages; $i++) {
            echo '<a href="?page=' . $i . '"';
            if ($i == $currentPage) {
                echo ' class="active"';
            } else{
              echo ' class="unactive"';
            }
            echo '>' . $i . '</a>';
        }
        echo '</div>';

        return;
    }

    $result = $connection->query($sql);
    $totalIdeas = $result->num_rows;
    if ($totalIdeas == 0) {
        echo "NOTHING";
        return;
    }

    $totalPages = ceil($totalIdeas / $ideasOnPage);

    if ($currentPage > $totalPages) {
        $currentPage = $totalPages;
    }
    if ($currentPage < 1) {
        $currentPage = 1;
    }

    $startIndex = ($currentPage - 1) * $ideasOnPage;
    $sql .= " LIMIT $startIndex, $ideasOnPage";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<a href='idea.php?id=" . $row["id"] . "' class='all-idea'>" . htmlspecialchars($row["title"]) . "</a><br>";
        }
    } else {
        echo "Error: ".$connection->error;
    }

    echo '<div class="numbers">';
    for ($i = 1; $i <= $totalPages; $i++) {
        echo '<a href="?page=' . $i . '"';
        if ($i == $currentPage) {
            echo ' class="active"';
        } else{
            echo ' class="unactive"';
        }
        echo '>' . $i . '</a>';
    }
    echo '</div>';

    $connection->close();
}

?>
