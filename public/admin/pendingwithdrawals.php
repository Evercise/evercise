

        <div id="page_wrapper">

            <!-- header -->
            <header id="main_header"></header>

            <!-- breadcrumbs -->
            <nav id="breadcrumbs"></nav>

            <!-- main content -->
            <div id="main_wrapper"></div>

            <!-- main menu -->
            <nav id="main_menu"></nav>


            <h1>Pending Withdrawals</h1>
            <table class="admin_table">
                <tr>
                    <th>user</th>
                    <th>payment type</th>
                    <th>payment details</th>
                    <th>amount</th>
                    <th>action</th>
                </tr>

                <?php foreach($pendingWithdrawals as $key => $withdrawal) { ?>
                    <tr>
                        <td><?php echo $withdrawal->user->first_name.' '.$withdrawal->user->last_name ?></td>
                        <td><?php echo  $withdrawal->acc_type ?></td>
                        <td><?php echo  $withdrawal->account ?> </td>
                        <td><?php echo  $withdrawal->transaction_amount ?> </td>
                        <td>
                        <?php echo  Form::open(array('id' => 'process'.$key, 'url' => 'admin/process_withdrawal', 'method' => 'post', 'class' => '')) ?>

                            <?php echo  Form::hidden( 'withdrawal_id' , $withdrawal->id, array('id' => 'withdrawal_id')) ?>

                            <?php echo  Form::submit('Mark Processed' , array('class'=>'btn-yellow ')) ?>

                        <?php echo  Form::close() ?>


                        </td>
                    </tr>
                <?php } ?>
            </table>
            <br>
            <br>
            <br>
            <h1>Recently Processed Withdrawals</h1>
            <table class="admin_table">
                <tr>
                    <th>user</th>
                    <th>payment type</th>
                    <th>payment details</th>
                    <th>amount</th>
                    <th>processed</th>
                </tr>

                <?php foreach($processedWithdrawals as $key => $withdrawal) { ?>
                    <tr>
                        <td><?php echo  $withdrawal->user->first_name.' '.$withdrawal->user->last_name ?></td>
                        <td><?php echo  $withdrawal->acc_type ?></td>
                        <td><?php echo  $withdrawal->account ?> </td>
                        <td><?php echo  $withdrawal->amount ?> </td>
                        <td><?php echo  $withdrawal->updated_at?></td>
                    </tr>
                <?php } ?>
            </table>

        </div>

        <!-- js plugins -->

        <!-- style switcher -->
        <div id="style_switcher"></div>

