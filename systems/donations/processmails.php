//you will need to properly modify this code, and use whatever email services API is required. 

<?
echo "Starting...\r\n";
try {
    $imapHost = 'imap.gmail.com';
    $imapPort = 993;
    $from = "fromaddress@example.com";
    $hostname = "{" . $imapHost . ':' . $imapPort . "/imap/ssl}INBOX";
    $username = "emailusername@example.com";
    $password = "password";
    $inbox = imap_open($hostname, $username, $password);
    $emails = imap_search($inbox, 'FROM "' . $from . '"');
    if ($emails) {
        foreach ($emails as $email) {
            $accountName = $quantity = null;
            $message = trim(imap_body($inbox, $email));

            $header = imap_header($inbox, $email);
            if (stripos($header->subject, "a common email title that can be parsed: New order") === false) {
                echo "Skipping: " . $header->subject . PHP_EOL;
                continue;
            } else
                echo "Processing: " . $header->subject . PHP_EOL;

            $lines = explode(PHP_EOL, $message);
            foreach ($lines as $line) {
                if (stripos($line, "Account Name: ") !== false)
                    $accountName = trim(str_replace("Account Name: ", '', $line));
                if (stripos($line, "Quantity: ") !== false)
                    $quantity = trim(str_replace("Quantity: ", '', $line));
            }

            if (!is_null($accountName) && !is_null($quantity)) {
                echo "Processing Telnet script: /src/uodir/telnetscriptname.sh " . $accountName . " " . $quantity . PHP_EOL;
                $result = exec("/src/uodir/telnetScript.sh $accountName $quantity");
                echo "Telnet script complete!\r\n";
            } else
                echo "Skipping Telnet, missing values!!!\r\n";

            echo "Deleteing processed message...\r\n";
            imap_delete($inbox, $email); // THIS MUST BE THE LAST LINE!!!!!!!!!!
        }
    }
    else
        echo "No orders found!\r\n";
} catch (Exception $e) {
    // Do Nothing
}
echo "Finished!\r\n";